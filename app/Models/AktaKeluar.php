<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktaKeluar extends Model
{
    use HasFactory;

    protected $table = 'outgoing_deeds';
    protected $fillable = [
        'deed_id',
        'name',
        'no_ktp',
        'telephone',
        'date_of_release',
        'quantity',
        'description',
        'new_status_deed',
        'created_id',
        'updated_id',
        'created_at',
        'updated_at'
    ];

    public function akta()
    {
        return $this->belongsTo(Akta::class, 'deed_id');
    }
}
