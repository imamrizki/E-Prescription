<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'resep';
    protected $fillable = [
        'resep_id',
        'resep_kode',
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

    public static function generateKodeResep()
    {
        $dateKode = 'RSP'.'-'.date('Ymd');

        $lastResep = Resep::where('resep_kode', 'like', $dateKode.'%')->max('resep_kode');
        
        $lastDateKode = !empty($lastResep) ? $lastResep : null;

        $kodeResep = $dateKode.'00001';
        
        if ($lastDateKode) {
            $lastNumber = str_replace($dateKode, '', $lastDateKode);
            $nextNumber = sprintf('%05d', (int)$lastNumber + 1);

            $kodeResep = $dateKode.$nextNumber;
        }

        return $kodeResep;
    }
}
