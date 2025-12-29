<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['source', 'destination', 'code', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'code' => 'integer',
    ];
}
