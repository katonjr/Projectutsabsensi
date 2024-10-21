<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedPlace extends Model
{
    use HasFactory;
    protected $table = 'featured_place';
    protected $guarded = [];
}
