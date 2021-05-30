<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'agenda_harians';
    protected $fillable = [
        'id',
        'nomor_surat',
        'tanggal',
        'jam',
        'tempat',
        'jenis_agenda',
        'tujuan_jenis',
        'tujuan_bidang',
        'tujuan_orang',
        'keterangan',
        'file_upload',
        'status',
        'deleted_at'
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class,'id', 'tujuan_orang')->withTrashed();
    }
    public function bidang()
    {
        return $this->hasMany(Bidang::class, 'id', 'tujuan_bidang')->withTrashed();
    }
}
