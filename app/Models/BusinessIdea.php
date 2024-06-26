<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessIdea extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['user_id'];
}
