<?php

namespace App\Models\Progen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgenFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

}
