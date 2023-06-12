<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persyaratan extends Model
{
    use HasFactory;

    protected $table = 'requirements';
    protected $fillable = [
        'deed_type_id',
        'name',
        'description',
        'status',
        'status_personal',
        'created_id',
        'updated_id'
    ];

    public function jenis_akta(){
        return $this->belongsTo(JenisAkta::class, 'deed_type_id', 'id');
    }

    public function persyaratan_akta(){
        return $this->hasMany(PersyaratanAkta::class, 'deed_type_id');
    }
}
