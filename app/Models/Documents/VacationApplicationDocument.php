<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;

class VacationApplicationDocument extends Model
{
    use HasFactory;

    protected $casts = [
    ];

    protected $appends = ['document'];

    protected $guarded = [];

    public function getDocumentAttribute()
    {
        return $this->attachment;
    }
}
