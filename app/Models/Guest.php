<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'nama_tamu', 'users_id', 'tlp_tamu', 'jabatan_tamu', 'instansi', 'foto'];

    protected $primaryKey = 'nip';

    public function queues()
    {
        return $this->hasMany('App\Models\Queue');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
