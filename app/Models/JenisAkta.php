<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAkta extends Model
{
    use HasFactory;

    protected $table = 'types_of_deeds';
    protected $fillable = [
        'name',
        'description',
        'status', 
        'created_id', 
        'updated_id'
    ];

    public function persyaratan(){
        return $this->hasMany(Persyaratan::class, 'deed_type_id');
    }

    public function akta(){
        return $this->hasMany(Akta::class, 'deed_type_id', 'id');
    }
    

}
