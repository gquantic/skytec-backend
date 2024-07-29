<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $casts = [
        'left' => 'array',
        'center' => 'array',
        'right' => 'array',
        'active' => 'boolean',
    ];
}
