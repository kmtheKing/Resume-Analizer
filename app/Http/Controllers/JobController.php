<?php

namespace App\Http\Controllers;

use App\Models\JobDescription;
use App\Models\Resume;
use App\Models\Analysis;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected GeminiService $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function index()
    {
        $jobs = JobDescription::latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        JobDescription::create($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job description created successfully.');
    }

    public function match(Request $request, Resume $resume)
    {
        $jobs = JobDescription::all();
        return view('jobs.match', compact('resume', 'jobs'));
    }

    public function analyze(Request $request, Resume $resume)
    {
        $request->validate([
            'job_id' => 'required|exists:job_descriptions,id',
        ]);

        $job = JobDescription::findOrFail($request->job_id);

        // check if analysis already exists
        $existingAnalysis = Analysis::where('resume_id', $resume->id)
            ->where('job_description_id', $job->id)
            ->first();

                if ($existingAnalysis) {

                     return redirect()->route('analysis.show', $existingAnalysis);

                }

        

                try {

                    $data = $this->geminiService->matchJob($resume->extracted_text, $job->description);

        

                    $analysis = Analysis::create([

                        'resume_id' => $resume->id,

                        'job_description_id' => $job->id,

                        'match_score' => $data['match_score'] ?? 0,

                        'feedback' => $data['feedback'] ?? [],

                    ]);

        

                    return redirect()->route('analysis.show', $analysis);

                } catch (\App\Exceptions\GeminiApiException $e) {

                    return back()->withErrors(['error' => 'Failed to match resume with job: ' . $e->getMessage()]);

                }

            }

        }

        