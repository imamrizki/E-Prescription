<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepNonracikan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'resep_nonracikan';
    protected $fillable = [
        'resep_nonracikan_id',
        'resep_id',
        'signa_id',
        'jumlah',
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

    // public function obat_alkes()
    // {
    //     return $this->belongsTo(ObatAlkes::class, 'obatalkes_id', 'obatalkes_id');
    // }
}
