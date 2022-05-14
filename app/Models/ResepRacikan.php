<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepRacikan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'resep_racikan';
    protected $fillable = [
        'resep_racikan_id',
        'resep_id',
        'signa_id',
        'resep_racikan_nama',
        'additional_data',
        'created_date',
        'created_by',
        'modified_count',
        'last_modified_date',
        'last_modified_by',
        'is_deleted',
        'is_active',
        'deleted_date',
        'deleted_by'
    ];
}
