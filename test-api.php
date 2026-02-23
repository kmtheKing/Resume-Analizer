<?php

use App\Services\GeminiService;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$service = new GeminiService();

$key = config('services.gemini.key');
echo "KEY FROM config: '" . $key . "'\n";

if ($key === 'your_api_key_here' || empty($key)) {
    echo "❌ KEY IS NOT CORRECT!\n";
    exit(1);
}

echo "Testing Gemini API...\n";

try {
    $result = $service->analyzeResume("Test resume text. Skills: PHP, Laravel.");
    echo "✅ API Success!\n";
    print_r($result);
} catch (\Exception $e) {
    echo "❌ API Test Failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
}