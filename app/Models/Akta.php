<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akta extends Model
{
    use HasFactory;

    protected $table = 'deeds';
    protected $fillable = [
        'business_entity_id',
        'deed_type_id',
        'deed_number',
        'deed_date',
        'business_name',
        'address',
        'deed_draft',
        'deed_copy',
        'description',
        'created_id',
        'updated_id',
        'created_at',
        'updated_at',
    ];

    public function jenis_akta(){
        return $this->belongsTo(JenisAkta::class, 'deed_type_id', 'id');
    }

    public function badan_usaha(){
        return $this->belongsTo(BadanUsaha::class, 'business_entity_id');
    }

    public function akta_keluar()
    {
        return $this->hasMany(AktaKeluar::class, 'deed_id', 'id');
    }

    public function penghadap()
    {
        return $this->hasMany(Penghadap::class);
    }

    public function persyaratan_akta()
    {
        return $this->hasMany(PersyaratanAkta::class);
    }


}
