<?php

namespace Tests\Unit;

use App\Services\FileParserService;
use Tests\TestCase;

class FileParserServiceTest extends TestCase
{
    protected FileParserService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FileParserService();
    }

    public function test_extract_text_returns_empty_string_for_unsupported_extension()
    {
        $result = $this->service->extractText('test.txt', 'txt');
        $this->assertEquals('', $result);
    }

    // Real PDF/DOCX testing would require actual files or complex mocking
}
