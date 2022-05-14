<?php

namespace App\Http\Controllers;

use App\Models\SignaPolicy;
use Illuminate\Http\Request;

class SignapolicyController extends Controller
{
    public function index()
    {
        $signapolicy = SignaPolicy::where('is_active', 1)->orderBy("signa_kode", "asc")->paginate(25);

        return view('pages.datamaster.signa_policy', compact('signapolicy'));
    }
}
