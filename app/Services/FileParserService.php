<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;

class FileParserService
{
    public function extractText(string $filePath, string $extension): string
    {
        if ($extension === 'pdf') {
            $parser = new Parser();
            $pdf = $parser->parseFile($filePath);
            return $pdf->getText();
        } elseif ($extension === 'docx') {
            $phpWord = IOFactory::load($filePath);
            $text = '';
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . "
";
                    }
                }
            }
            return $text;
        }

        return '';
    }
}
