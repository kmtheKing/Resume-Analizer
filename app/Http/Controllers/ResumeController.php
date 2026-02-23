<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Services\GeminiService;
use App\Services\FileParserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    protected GeminiService $geminiService;
    protected FileParserService $fileParserService;

    public function __construct(GeminiService $geminiService, FileParserService $fileParserService)
    {
        $this->geminiService = $geminiService;
        $this->fileParserService = $fileParserService;
    }

    public function index()
    {
        $resumes = Resume::latest()->get();
        return view('resumes.index', compact('resumes'));
    }

    public function upload()
    {
        return view('resumes.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,docx|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        $file = $request->file('resume');
        $path = $file->store('resumes');
        $extension = $file->getClientOriginalExtension();

        $text = $this->fileParserService->extractText(storage_path('app/private/' . $path), $extension);

        try {
            $analysis = $this->geminiService->analyzeResume($text);

            $resume = Resume::create([
                'name' => $request->name ?? $file->getClientOriginalName(),
                'file_path' => $path,
                'extracted_text' => $text,
                'analysis_results' => $analysis,
            ]);

            return redirect()->route('resumes.show', $resume)->with('success', 'Resume uploaded and analyzed successfully.');
        } catch (\App\Exceptions\GeminiApiException $e) {
            return back()->withErrors(['resume' => 'Failed to analyze resume with AI: ' . $e->getMessage()]);
        }
    }

    public function show(Resume $resume)
    {
        return view('resumes.show', compact('resume'));
    }
}