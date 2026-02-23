# Resume Analyzer Project Context

## Overview
The Resume Analyzer is a web application built with Laravel that allows users to upload resumes, extract key information using AI, and match them against job descriptions.

## Tech Stack
- **Framework**: Laravel 12
- **Language**: PHP 8.2+
- **Database**: SQLite (Development)
- **Frontend**: Blade, Tailwind CSS
- **AI**: Gemini API

## Core Features
1. **Resume Upload**: Support PDF and DOCX formats.
2. **Parsing**: Extract text from uploaded files.
3. **AI Analysis**: Identify skills, work history, and education.
4. **Job Matching**: Compare resumes with job descriptions to calculate a compatibility score.
5. **Dashboard**: View status and results of analyses.

## Current Progress
- [x] Initial Laravel project setup.
- [x] Conductor extension installed.
- [x] Configure environment (MySQL & Gemini API placeholder).
- [x] Database Migrations (Resumes, Job Descriptions, Analyses).
- [x] Models and Controllers created.
- [x] Basic UI (Dashboard, Upload, Show Analysis).
- [x] Integration with PDF and DOCX parsing libraries.
- [x] Gemini Service implemented.
- [x] Implement Job Matching functionality.

## Next Steps
- [x] Add more comprehensive error handling for AI responses.
- [x] UI Polishing (Tailwind components).
- [x] Unit Tests for Extraction and Service logic.

## Future Enhancements
- [ ] Add support for more file formats (e.g., TXT, RTF).
- [ ] Implement user authentication for private resume management.
- [ ] Add a "History" view for all past analyses.
- [ ] Allow users to export analysis results as PDF.
