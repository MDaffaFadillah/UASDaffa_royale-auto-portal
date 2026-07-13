<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LuxuryCar extends Model
{
    use HasUuids;

    protected $fillable = [
        'model_name', 'tag_line', 'description', 'engine_specs', 
        'gallery_images', 'indicative_price', 'availability_status'
    ];

    // Otomatis mengubah JSON database menjadi Array PHP
    protected function casts(): array
    {
        return [
            'engine_specs' => 'array',
            'gallery_images' => 'array',
        ];
    }
}