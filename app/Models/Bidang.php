<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidang extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id', 
        'name',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function agenda()
    {
        return $this->belongsToMany(Agenda::class);
    }
}
