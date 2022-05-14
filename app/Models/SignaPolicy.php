<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignaPolicy extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'signa_m';
    protected $fillable = [
        'signa_id',
        'signa_kode',
        'signa_nama',
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

    public static function dropdownSignaPolicy()
    {
        $signaPolicy = SignaPolicy::where('is_active', 1)->orderBy("signa_kode", "asc")->get();
        $signaDropdown = '';
        foreach ($signaPolicy as $value) {
            $signaDropdown .= '<option value="'.$value->signa_id.'">'.$value->signa_nama.'</option>';
        }

        return $signaDropdown;
    }
}
