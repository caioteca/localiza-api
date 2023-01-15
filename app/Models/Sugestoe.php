<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugestoe extends Model
{
    use HasFactory;
    protected $fillable = [
        'sugestao', 'type','id_user'
    ];
}
