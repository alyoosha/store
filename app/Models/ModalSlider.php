<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalSlider extends Model
{
    use HasFactory;

    protected $table = 'modal_slider';

    public $timestamps = false;

    public function scopeIsActive($query) {
        return $query->where('is_active', 1);
    }
}
