@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-3xl font-bold leading-7 text-gray-900 sm:text-4xl sm:truncate">
                Add Job Description
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Create a new job description to start matching it against uploaded resumes.
            </p>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" required
                                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="e.g. Senior Full Stack Developer">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Full Description</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="12" required
                                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="Paste the responsibilities, requirements, and company info here..."></textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">The more detailed the description, the better the AI matching will be.</p>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('jobs.index') }}" 
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Job Description
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
