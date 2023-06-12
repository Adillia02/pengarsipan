<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'positions';
    protected $fillable = [
        'name',
        'description',
        'status', 
        'created_id', 
        'updated_id'
    ];
}
