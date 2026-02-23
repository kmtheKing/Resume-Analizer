<?php

namespace Tests\Unit;

use App\Exceptions\GeminiApiException;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GeminiServiceTest extends TestCase
{
    protected GeminiService $service;

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.gemini.key' => 'test-key']);
        $this->service = new GeminiService();
    }

    public function test_analyze_resume_returns_validated_array()
    {
        Http::fake([
            '*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => json_encode([
                                    'skills' => ['PHP', 'Laravel'],
                                    'experience' => [],
                                    'education' => [],
                                    'summary' => 'Test summary'
                                ])]
                            ]
                        ]
                    ]
                ]
            ], 200)
        ]);

        $result = $this->service->analyzeResume('Some resume text');

        $this->assertIsArray($result);
        $this->assertEquals(['PHP', 'Laravel'], $result['skills']);
        $this->assertEquals('Test summary', $result['summary']);
    }

    public function test_analyze_resume_handles_missing_fields()
    {
        Http::fake([
            '*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => json_encode([
                                    'skills' => ['PHP'],
                                    // missing other fields
                                ])]
                            ]
                        ]
                    ]
                ]
            ], 200)
        ]);

        $result = $this->service->analyzeResume('Some resume text');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('experience', $result);
        $this->assertArrayHasKey('education', $result);
        $this->assertArrayHasKey('summary', $result);
        $this->assertNull($result['summary']);
    }

    public function test_call_gemini_throws_exception_on_api_error()
    {
        Http::fake([
            '*' => Http::response([
                'error' => ['message' => 'Invalid API Key']
            ], 400)
        ]);

        $this->expectException(GeminiApiException::class);
        $this->expectExceptionMessage('Gemini API error: Invalid API Key');

        $this->service->analyzeResume('Some text');
    }

    public function test_match_job_returns_validated_array()
    {
        Http::fake([
            '*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => json_encode([
                                    'match_score' => 85,
                                    'feedback' => [
                                        'strengths' => ['Strong Laravel skills'],
                                        'weaknesses' => [],
                                        'suggestions' => []
                                    ]
                                ])]
                            ]
                        ]
                    ]
                ]
            ], 200)
        ]);

        $result = $this->service->matchJob('Resume text', 'Job description');

        $this->assertIsArray($result);
        $this->assertEquals(85, $result['match_score']);
        $this->assertIsArray($result['feedback']);
    }
}
