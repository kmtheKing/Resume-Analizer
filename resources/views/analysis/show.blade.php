@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('resumes.index') }}" class="hover:text-gray-700">Resumes</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('resumes.show', $analysis->resume_id) }}" class="hover:text-gray-700">{{ $analysis->resume->name }}</a></li>
                <li><span>/</span></li>
                <li class="font-medium text-gray-900">Analysis</li>
            </ol>
        </nav>
        <h1 class="text-3xl font-bold text-gray-900">Matching Results</h1>
        <p class="text-gray-600">
            For <strong>{{ $analysis->jobDescription->title }}</strong>
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Match Score Card -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg overflow-hidden p-8 text-center border-t-4 {{ $analysis->match_score >= 70 ? 'border-green-500' : ($analysis->match_score >= 40 ? 'border-yellow-500' : 'border-red-500') }}">
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4">Match Score</h2>
            <div class="relative inline-flex items-center justify-center">
                <svg class="w-32 h-32">
                    <circle class="text-gray-200" stroke-width="8" stroke="currentColor" fill="transparent" r="58" cx="64" cy="64"/>
                    <circle class="{{ $analysis->match_score >= 70 ? 'text-green-500' : ($analysis->match_score >= 40 ? 'text-yellow-500' : 'text-red-500') }}" stroke-width="8" stroke-dasharray="{{ ($analysis->match_score / 100) * 364.4 }}" stroke-linecap="round" stroke="currentColor" fill="transparent" r="58" cx="64" cy="64"/>
                </svg>
                <span class="absolute text-3xl font-extrabold {{ $analysis->match_score >= 70 ? 'text-green-600' : ($analysis->match_score >= 40 ? 'text-yellow-500' : 'text-red-500') }}">
                    {{ $analysis->match_score }}%
                </span>
            </div>
            <p class="mt-4 text-sm font-medium text-gray-700">
                @if($analysis->match_score >= 80)
                    Excellent Match! 🚀
                @elseif($analysis->match_score >= 60)
                    Good potential. 👍
                @else
                    Significant gaps found. ⚠️
                @endif
            </p>
        </div>
    </div>

    <!-- Feedback Details -->
    <div class="lg:col-span-3 space-y-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-green-50">
                <h2 class="text-lg font-bold text-green-800 flex items-center gap-2">
                    <span>🌟</span> Key Strengths
                </h2>
            </div>
            <div class="px-6 py-6">
                <ul class="space-y-3">
                    @forelse($analysis->feedback['strengths'] ?? [] as $strength)
                        <li class="flex items-start gap-3 text-gray-700">
                            <span class="text-green-500 mt-1">✓</span>
                            {{ $strength }}
                        </li>
                    @empty
                        <li class="text-gray-500 italic">No specific strengths identified.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-red-50">
                <h2 class="text-lg font-bold text-red-800 flex items-center gap-2">
                    <span>🔍</span> Areas for Improvement / Gaps
                </h2>
            </div>
            <div class="px-6 py-6">
                <ul class="space-y-3">
                    @forelse($analysis->feedback['weaknesses'] ?? [] as $weakness)
                        <li class="flex items-start gap-3 text-gray-700">
                            <span class="text-red-500 mt-1">!</span>
                            {{ $weakness }}
                        </li>
                    @empty
                        <li class="text-gray-500 italic">No specific weaknesses identified.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden border border-purple-200">
            <div class="px-6 py-5 border-b border-gray-200 bg-purple-50">
                <h2 class="text-lg font-bold text-purple-800 flex items-center gap-2">
                    <span>💡</span> Recommendations
                </h2>
            </div>
            <div class="px-6 py-6">
                <ul class="space-y-4">
                    @forelse($analysis->feedback['suggestions'] ?? [] as $suggestion)
                        <li class="bg-purple-50 border border-purple-100 p-4 rounded-lg text-gray-800 italic">
                            "{{ $suggestion }}"
                        </li>
                    @empty
                        <li class="text-gray-500 italic">No recommendations available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
