<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    use HasFactory;

    protected $table = 'main_slider';
    public $timestamps = false;

    protected function scopeActive($query) {
        return $query->where('is_active', 1);
    }
}
