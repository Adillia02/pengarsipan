<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BadanUsaha extends Model
{
    use HasFactory;

    protected $table = 'business_entities';
    protected $fillable = [
        'name',
        'abbreviation',
        'description',
        'status', 
        'created_id', 
        'updated_id'
    ];

    public function akta(){
        return $this->hasMany(Akta::class, 'business_entity_id');
    }
}
