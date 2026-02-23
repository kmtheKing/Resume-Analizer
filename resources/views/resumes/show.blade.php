@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('resumes.index') }}" class="hover:text-gray-700">Resumes</a></li>
                <li><span>/</span></li>
                <li class="font-medium text-gray-900">{{ $resume->name }}</li>
            </ol>
        </nav>
        <h1 class="text-3xl font-bold text-gray-900">{{ $resume->name }}</h1>
        <p class="text-gray-500">Uploaded on {{ $resume->created_at->format('M d, Y') }}</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('jobs.match', $resume) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <span class="mr-2">🎯</span> Match with Job
        </a>
    </div>
</div>

@if($resume->analysis_results)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Summary & Skills -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                        <span>📝</span> Professional Summary
                    </h2>
                </div>
                <div class="px-6 py-6">
                    <p class="text-gray-700 leading-relaxed text-lg">
                        {{ $resume->analysis_results['summary'] ?? 'No summary available.' }}
                    </p>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                        <span>💼</span> Work Experience
                    </h2>
                </div>
                <div class="px-6 py-6">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach($resume->analysis_results['experience'] ?? [] as $index => $exp)
                            <li>
                                <div class="relative pb-8">
                                    @if($index !== count($resume->analysis_results['experience']) - 1)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <span class="text-white text-xs">🏢</span>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">{{ $exp['title'] ?? 'Title N/A' }}</p>
                                                <p class="text-sm text-gray-500">{{ $exp['company'] ?? 'Company N/A' }}</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time>{{ $exp['duration'] ?? '' }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Skills & Education -->
        <div class="space-y-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                        <span>🛠️</span> Key Skills
                    </h2>
                </div>
                <div class="px-6 py-6">
                    <div class="flex flex-wrap gap-2">
                        @foreach($resume->analysis_results['skills'] ?? [] as $skill)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                        <span>🎓</span> Education
                    </h2>
                </div>
                <div class="px-6 py-6">
                    <ul class="space-y-4">
                        @foreach($resume->analysis_results['education'] ?? [] as $edu)
                            <li>
                                <h3 class="text-sm font-bold text-gray-900">{{ $edu['degree'] ?? $edu['school'] ?? 'Education Info' }}</h3>
                                <p class="text-xs text-gray-500">{{ $edu['school'] ?? '' }} • {{ $edu['year'] ?? '' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-gray-100 rounded-lg p-6 border border-gray-200">
                <h2 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wider">Original Text</h2>
                <div class="max-h-60 overflow-y-auto text-[10px] text-gray-500 font-mono whitespace-pre-wrap leading-tight">
                    {{ $resume->extracted_text }}
                </div>
            </div>
        </div>
    </div>
@else
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0 text-yellow-400">⚠️</div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    Analysis results not available for this resume. 
                    <a href="#" class="font-medium underline hover:text-yellow-600">Try re-analyzing</a>.
                </p>
            </div>
        </div>
    </div>
@endif
@endsection
