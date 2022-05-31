<?php

namespace App\Http\Controllers;

use PDF, View;
use Carbon\Carbon;
use App\Models\Resep;
use App\Models\ObatAlkes;
use App\Models\SignaPolicy;
use App\Models\ResepRacikan;
use Illuminate\Http\Request;
use App\Models\ResepNonracikan;
use App\Models\ResepRacikanDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PrescriptionController extends Controller
{

    public function test()
    {
        return $this->coba;
    }

    public function index()
    {
        dd($this->coba);
        // $resep = Resep::where('is_active', 1)->orderBy("resep_kode", "desc")->paginate(25);

        // return view('pages.transactions.prescription', compact('resep'));
    }

    public function submitResep(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            $resep = new Resep;
            $resep->resep_kode = Resep::generateKodeResep();
            $resep->created_date = Carbon::now();
            $resep->last_modified_date = Carbon::now();
            $resep->save();
    
            // insert non racikan table
            if (isset($request->nonracik_obatalkes_id)) {
                foreach ($request->nonracik_obatalkes_id as $key => $nonracik) {
                    $resepNonracikan = new ResepNonracikan;
                    $resepNonracikan->resep_id = $resep->id;
                    $resepNonracikan->obatalkes_id = $request->nonracik_obatalkes_id[$key];
                    $resepNonracikan->signa_id = $request->nonracik_signa_id[$key];
                    $resepNonracikan->jumlah = $request->nonracik_jumlah[$key];
                    $resepNonracikan->save();

                    // kurangi stok obat alkes
                    $obat_alkes = ObatAlkes::where('obatalkes_id', $request->nonracik_obatalkes_id[$key])->first();
                    ObatAlkes::where('obatalkes_id', $request->nonracik_obatalkes_id[$key])->update([
                        'stok' => $obat_alkes->stok - $request->nonracik_jumlah[$key]
                    ]);
                }
            }

            // insert racikan table
            if (isset($request->racik_resep_racikan_nama)) {
                foreach ($request->racik_resep_racikan_nama as $key => $racikan) {
                    $resepRacikan = new ResepRacikan;
                    $resepRacikan->resep_id = $resep->id;
                    $resepRacikan->signa_id = $request->racik_signa_id[$key];
                    $resepRacikan->resep_racikan_nama = $request->racik_resep_racikan_nama[$key];
                    $resepRacikan->save();
                }

                foreach ($request->racik_obatalkes_id as $key2 => $subracikan) {
                    $resepSubRacikan = new ResepRacikanDetail;
                    $resepSubRacikan->resep_racikan_id = $resepRacikan->id;
                    $resepSubRacikan->obatalkes_id = $request->racik_obatalkes_id[$key2];
                    $resepSubRacikan->jumlah = $request->racik_jumlah[$key2];
                    $resepSubRacikan->save();

                    // kurangi stok obat alkes
                    $obat_alkes = ObatAlkes::where('obatalkes_id', $request->racik_obatalkes_id[$key2])->first();
                    ObatAlkes::where('obatalkes_id', $request->racik_obatalkes_id[$key2])->update([
                        'stok' => $obat_alkes->stok - $request->racik_jumlah[$key2]
                    ]);
                }

            }

            DB::commit();

            return response()->json(['message' => 'Resep berhasil dibuat.']);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function pdfResep($id)
    {
        $resep_id = Crypt::decryptString($id);
        $resep = DB::select("SELECT * FROM resep WHERE resep_id = $resep_id")[0];

        $nonracik = DB::select("SELECT * FROM resep_nonracikan WHERE resep_id = $resep_id");
        $htmlNonRacik = '';
        foreach ($nonracik as $key => $value) {
            $obatalkes = ObatAlkes::where('obatalkes_id', $value->obatalkes_id)->first();
            $signapolicy = SignaPolicy::where('signa_id', $value->signa_id)->first();
            $htmlNonRacik .= '
            <tr>
                <td style="text-align:center;">R /</td>
                <td></td>
            </tr>
            <tr>
                <td style="height: 25px; text-align:center;"></td>
                <td style="height: 25px;">'.$obatalkes->obatalkes_nama.' ('.$value->jumlah.')</td>
            </tr>
            <tr>
                <td style="height: 25px; text-align:center;"></td>
                <td style="height: 25px;">'.$signapolicy->signa_nama.'</td>
            </tr>';
        }

        $racik = DB::select("SELECT * FROM resep_racikan WHERE resep_id = $resep_id");
        $htmlRacik = '';
        foreach ($racik as $key => $value) {
            // $obatalkes = ObatAlkes::where('obatalkes_id', $value->obatalkes_id)->first();
            $signapolicy = SignaPolicy::where('signa_id', $value->signa_id)->first();
            $htmlRacik .= '
            <tr>
                <td style="text-align:center;">R /</td>
                <td></td>
            </tr>
            <tr>
                <td style="height: 25px; text-align:center;"></td>
                <td style="height: 25px;">'.$value->resep_racikan_nama.'</td>
            </tr>
            <tr>
                <td style="height: 25px; text-align:center;"></td>
                <td style="height: 25px;">'.$signapolicy->signa_nama.'</td>
            </tr>';
        }
        // dd($nonracik);

        $data['kodeResep'] = $resep->resep_kode;
        $data['resepNonRacik'] = $htmlNonRacik;
        $data['resepRacik'] = $htmlRacik;

        PDF::setHeaderCallback(function($pdf) {
            $head = '
                <table border="0" width="100%" style="border-bottom: 1px solid black;">
                    <tr style="text-align: center;">
                        <td>
                            PT. Citra Raya Nusatama (dHealth)
                        </td>
                    </tr>
                    <tr style="text-align: center; font-size: 10px;">
                        <td style="height: 25px;">
                            Jl. Dr. Setiabudi No.301, Isola, Kec. Sukasari, Kota Bandung, Jawa Barat
                        </td>
                    </tr>
                </table>';

            $pdf->SetFont('helvetica', '', 14);
            $pdf->SetMargins(5, 30, 5, true);
            $pdf->SetY(10);
            $pdf->writeHTML($head,  true, false, true, false, '');
        });
        
        $view = View::make('layouts.pdf_resep', $data);
        $html = $view->render();

        $pdf = new PDF();
        $pdf::SetTitle('Resep Digital');
        $pdf::SetMargins(5, 20, 5, true);
        $pdf::SetFontSubsetting(false);
        $pdf::SetFontSize('9px');
        // $pdf::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf::AddPage('P', 'A5');
        $pdf::setPrintHeader(false);
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('Resep Digital.pdf', 'I');
        exit();
    }
}
