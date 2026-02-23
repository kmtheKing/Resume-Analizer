<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $guarded = [];

    protected $casts = [
        'analysis_results' => 'array',
    ];

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }
}
