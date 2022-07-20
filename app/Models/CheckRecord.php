<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        "type" ,
        "status" ,
        "data" ,
        "check_id"
    ];
}
