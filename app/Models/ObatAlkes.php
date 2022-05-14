<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatAlkes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'obatalkes_m';
    protected $fillable = [
        'obatalkes_id',
        'obatalkes_kode',
        'obatalkes_nama',
        'stok',
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

    // public function resep_non_racikan()
    // {
    //     return $this->hasMany(ResepNonRacikan::class, 'obatalkes_id', 'obatalkes_id');
    // }

    public static function dropdownObatAlkes()
    {
        $obatalkes = ObatAlkes::where('is_active', 1)->orderBy("obatalkes_kode", "asc")->get();
        $obatDropdown = '';
        foreach ($obatalkes as $value) {
            $disabled = '';
            if ($value->stok == 0) {
                $disabled = 'disabled';
            }
            $obatDropdown .= '<option value="'.$value->obatalkes_id.'" data-subtext="Sisa stok : '.$value->stok.'" '.$disabled.'>'.$value->obatalkes_nama.'</option>';
        }

        return $obatDropdown;
    }
}
