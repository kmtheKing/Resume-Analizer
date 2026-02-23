<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    protected $guarded = [];

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }
}
