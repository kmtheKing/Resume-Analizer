@extends('layouts.app')

@section('content')
<div class="text-center py-12">
    <h1 class="text-5xl font-extrabold text-gray-900 mb-6">
        Analyze Your Resume with <span class="text-blue-600">AI</span>
    </h1>
    <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
        Upload your resume and let our AI-powered tool extract skills, experience, and match you with the perfect job descriptions.
    </p>

    <div class="flex justify-center gap-4">
        <a href="{{ route('resumes.upload') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-blue-700 transition">
            Upload Resume
        </a>
        <a href="{{ route('resumes.index') }}" class="bg-white text-blue-600 border border-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-blue-50 transition">
            View Dashboard
        </a>
    </div>

    <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="text-blue-600 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Smart Extraction</h3>
            <p class="text-gray-600">Automatically extracts skills, work history, and education from PDF and DOCX files.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="text-blue-600 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">AI Analysis</h3>
            <p class="text-gray-600">Powered by Gemini AI to provide deep insights and summaries of your professional profile.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="text-blue-600 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Job Matching</h3>
            <p class="text-gray-600">Compare your resume against any job description to see how well you match.</p>
        </div>
    </div>
</div>
@endsection
