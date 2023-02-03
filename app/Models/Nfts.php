<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'discription',
        'twitter',
        'discord',
        'website',
        'price',
        'blockchain',
        'supply',
        'imgurl',
        'is_featured'
    ];
}
