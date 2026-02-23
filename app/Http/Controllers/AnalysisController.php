<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function show(Analysis $analysis)
    {
        return view('analysis.show', compact('analysis'));
    }
}