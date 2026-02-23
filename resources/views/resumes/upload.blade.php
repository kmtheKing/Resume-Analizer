@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Upload Resume</h1>
        <p class="mt-1 text-sm text-gray-500">
            Upload your resume in PDF or DOCX format. Our AI will extract key details automatically.
        </p>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('resumes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Display Name (Optional)</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name"
                                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="e.g. John Doe - Full Stack Developer">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Resume File</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition">
                            <div class="space-y-1 text-center">
                                <span class="text-4xl block mb-2">📄</span>
                                <div class="flex text-sm text-gray-600">
                                    <label for="resume" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                        <span>Upload a file</span>
                                        <input id="resume" name="resume" type="file" class="sr-only" required accept=".pdf,.docx">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF or DOCX up to 2MB</p>
                            </div>
                        </div>
                        <div id="file-name" class="mt-2 text-sm text-blue-600 font-medium hidden"></div>
                        @error('resume')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Upload & Start AI Analysis
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('resume').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : '';
        const display = document.getElementById('file-name');
        if (fileName) {
            display.textContent = 'Selected file: ' + fileName;
            display.classList.remove('hidden');
        } else {
            display.classList.add('hidden');
        }
    });
</script>
@endsection
