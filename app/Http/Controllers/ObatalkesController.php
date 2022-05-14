<?php

namespace App\Http\Controllers;

use App\Models\ObatAlkes;
use Illuminate\Http\Request;

class ObatalkesController extends Controller
{
    public function index()
    {
        $obatalkes = ObatAlkes::where('is_active', 1)->orderBy("obatalkes_kode", "asc")->paginate(25);

        return view('pages.datamaster.obat_alkes', compact('obatalkes'));
    }

    public function modalObatalkes()
    {
        $obatalkes = ObatAlkes::where('is_active', 1)->orderBy("obatalkes_kode", "asc")->paginate(10);

        $dataTable = '';
        if (count($obatalkes) > 0) {
            foreach ($obatalkes as $item) {
                $dataTable .= '
                    <tr>
                        <td class="text-center">
                            <input class="form-check-input" type="checkbox" name="obatalkes[]" value="'.$item->obatalkes_id.'">
                        </td>
                        <td>'.$item->obatalkes_kode.'</td>
                        <td>'.$item->obatalkes_nama.'</td>
                        <td>'.$item->stok.'</td>
                    </tr>
                ';
            }
        } else {
            $dataTable .= '<tr><td colspan="6" class="text-center">Data tidak tersedia !</td></tr>';
        }

        $modal['size']     = 'modal-lg';
        $modal['title']    = 'Pilih Obat Alkes';
        $modal['content']  = '
            <form data-action="'.route('terapkan_nonracik').'" method="POST" id="terapkanObatalkes">
                <div class="modal-body">
                    <table class="table align-items-center table-flush" style="height:20px; overflow-y:scroll">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$dataTable.'
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary" id="submitTerapkan">Terapkan</button>
                </div>
            </form>
        ';

        return response()->json($modal);
    }
}
