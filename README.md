# Resume Analyzer

Resume Analyzer is a powerful web application built with Laravel that leverages AI to streamline the recruitment process. It allows users to upload resumes, automatically extract key information, and match them against specific job descriptions to calculate compatibility scores.

## 🚀 Features

-   **Resume Upload**: Support for PDF and DOCX formats.
-   **AI-Powered Parsing**: Automatically extracts skills, work history, and education using the Gemini API.
-   **Job Matching**: Compare resumes against job descriptions to get a compatibility score and detailed analysis.
-   **Dashboard**: Manage uploaded resumes and view past analyses.
-   **Modern UI**: Clean and responsive interface built with Tailwind CSS.

## 🛠️ Tech Stack

-   **Framework**: [Laravel 12](https://laravel.com)
-   **Language**: PHP 8.2+
-   **Database**: SQLite (Development)
-   **Frontend**: Blade, [Tailwind CSS](https://tailwindcss.com)
-   **AI Integration**: [Google Gemini API](https://ai.google.dev/)
-   **File Parsing**: `smalot/pdfparser`, `phpoffice/phpword`

## 📋 Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   Gemini API Key

## ⚙️ Installation

1.  **Clone the repository**:
    ```bash
    git clone <repository-url>
    cd Resume-Analyzer
    ```

2.  **Install PHP dependencies**:
    ```bash
    composer install
    ```

3.  **Install NPM dependencies**:
    ```bash
    npm install
    ```

4.  **Environment Setup**:
    Copy `.env.example` to `.env` and configure your settings:
    ```bash
    cp .env.example .env
    ```
    Make sure to add your `GEMINI_API_KEY` in the `.env` file:
    ```env
    GEMINI_API_KEY=your_api_key_here
    ```

5.  **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations**:
    ```bash
    php artisan migrate
    ```

7.  **Build Assets**:
    ```bash
    npm run build
    ```

8.  **Start the Server**:
    ```bash
    php artisan serve
    ```

## 🧪 Running Tests

To run the feature and unit tests:
```bash
php artisan test
```

## 📄 License

The Resume Analyzer is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
