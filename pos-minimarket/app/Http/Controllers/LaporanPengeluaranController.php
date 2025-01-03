<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanPengeluaranController extends Controller
{
    //
    public function index()
    {
        $tanggal_awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggal_akhir = date('Y-m-d');
        return view('laporan_pengeluaran.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function getData($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $pengeluaran = 0;

        $total_pengeluaran = 0;

        while(strtotime($awal) <= strtotime($akhir)){
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $pengeluaran_detail = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->get();
            $pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $total_pengeluaran += $pengeluaran;

            foreach ($pengeluaran_detail     as $detail) {
                $row = [];
                $row['DT_RowIndex'] = $no++;
                $row['tanggal'] = tanggal_indonesia($tanggal, false);
                $row['deskripsi'] = $detail->deskripsi;
                $row['pengeluaran'] = format_uang($detail->nominal);
                $data[] = $row;
            }
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'deskripsi' => 'Total Pengeluaran',
            'pengeluaran' => format_uang($total_pengeluaran),

        ];

        return $data;
    }

    public function data($awal, $akhir){
   
        $data = $this->getData($awal, $akhir);
        return datatables()
        ->of($data)
        ->make(true);
    }

    public function refresh(Request $request){
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        return view('laporan_pengeluaran.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function exportPDF($awal, $akhir){
        $data = $this->getData($awal, $akhir);
        $pdf = Pdf::loadView('laporan_pengeluaran.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-Pengeluaran-' . date('Y-m-d-his') . '.pdf');
    }
}
