<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    protected $guarded = [];

    protected $casts = [
        'feedback' => 'array',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function jobDescription()
    {
        return $this->belongsTo(JobDescription::class);
    }
}
