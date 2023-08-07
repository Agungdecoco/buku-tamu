<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'nama_konsultan', 'tlp_konsultan', 'email_konsultan', 'jabatan_konsultan'];
    protected $primaryKey = 'nip';

    public function queues()
    {
        return $this->hasMany('App\Models\Queue');
    }
}
