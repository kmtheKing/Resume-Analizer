<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Resume Analyzer') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                            <span>📄</span>
                            <span>ResumeAI</span>
                        </a>
                    </div>
                    <div class="hidden sm:-my-px sm:ml-8 sm:flex sm:space-x-8">
                        <a href="{{ route('resumes.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('resumes.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            Resumes
                        </a>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('jobs.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            Jobs
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('resumes.upload') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Upload Resume
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0 text-green-400">
                        ✅
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="rounded-md bg-red-50 p-4 mb-6 border border-red-200">
                <div class="flex">
                    <div class="flex-shrink-0 text-red-400">
                        ❌
                    </div>
                    <div class="ml-3">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm font-medium text-red-800">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} ResumeAI Analyzer. Powered by Gemini.
            </p>
        </div>
    </footer>
</body>
</html>
