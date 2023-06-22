<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersyaratanAkta extends Model
{
    use HasFactory;

    protected $table = 'requirements_deed';
    protected $fillable = [
        'attendees_id',
        'deed_id',
        'requirement_id',
        'file',
        'created_id',
        'updated_id',
        'created_at',
        'updated_at',
    ];

    public function penghadap(){
        return $this->belongsTo(Penghadap::class, 'deed_id');
    }

    public function akta(){
        return $this->belongsTo(Akta::class, 'attendees_id');
    }

    public function persyaratan(){
        return $this->belongsTo(Persyaratan::class, 'requirements_id');
    }



}
