<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = ['tgl_konsultasi', 'sesi', 'consultants_nip', 'guests_nip', 'topik', 'tipe_konsultasi', 'ruang', 'anggota1', 'anggota2', 'anggota3'];

    public function consultants()
    {
        return $this->belongsTo('App\Models\Consultant', 'consultants_nip');
    }

    public function guests()
    {
        return $this->belongsTo('App\Models\Guest', 'guests_nip');
    }
}
