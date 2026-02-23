@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Match Resume</h1>
        <p class="mt-1 text-sm text-gray-500">
            Compare <strong>{{ $resume->name }}</strong> against your saved job descriptions.
        </p>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-8 flex items-center p-4 bg-blue-50 rounded-lg border border-blue-100">
                <span class="text-3xl mr-4">📄</span>
                <div>
                    <h2 class="text-sm font-bold text-blue-900 uppercase tracking-wider">Target Resume</h2>
                    <p class="text-lg font-medium text-blue-800">{{ $resume->name }}</p>
                </div>
            </div>

            <form action="{{ route('jobs.analyze', $resume) }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="job_id" class="block text-sm font-medium text-gray-700">Select Job Description</label>
                        <select id="job_id" name="job_id" required
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border p-2">
                            <option value="">-- Choose a saved job description --</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}">{{ $job->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-4 flex flex-col gap-4">
                        <button type="submit"
                            class="w-full inline-flex justify-center items-center py-3 px-4 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="mr-2">🎯</span> Run AI Matching Analysis
                        </button>
                        
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="px-2 bg-white text-sm text-gray-500">or</span>
                            </div>
                        </div>

                        <a href="{{ route('jobs.create') }}" 
                            class="w-full inline-flex justify-center items-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <span class="mr-2">➕</span> Create New Job Description
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
