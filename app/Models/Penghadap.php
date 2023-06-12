<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghadap extends Model
{
    use HasFactory;

    protected $table = 'attendees';
    protected $fillable = [
        'deed_id',
        'name',
        'part',
        'description',
        'created_id',
        'updated_id',
        'created_at',
        'updated_at',
    ];

    public function akta(){
        return $this->belongsTo(Akta::class, 'deed_id');
    }

    public function persyaratan_akta()
    {
        return $this->hasMany(PersyaratanAkta::class);
    }



}
