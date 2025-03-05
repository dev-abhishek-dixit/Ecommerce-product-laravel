<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_name',
        'modal_name',
        'audio_name'
    ];
}
