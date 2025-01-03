<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //

    public function index(){
        $tanggal_awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggal_akhir = date('Y-m-d');
        return view('laporan.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function getData($awal, $akhir){
        $no = 1;
        $data = array();
        $pendapatan = 0;
        $total_pendapatan = 0;

        while(strtotime($awal) <= strtotime($akhir)){
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['DT_RowIndex'] =$no++;
            $row['tanggal'] = tanggal_indonesia($tanggal, false);    
            $row['penjualan'] = format_uang($total_penjualan);
            $row['pembelian'] = format_uang($total_pembelian);
            $row['pengeluaran'] = format_uang($total_pengeluaran);
            $row['pendapatan'] = format_uang($pendapatan);

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'penjualan' => '',
            'pembelian' => '',
            'pengeluaran' => 'Total Pendapatan',
            'pendapatan' => format_uang($total_pendapatan),
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

        return view('laporan.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function exportPDF($awal, $akhir){
        $data = $this->getData($awal, $akhir);
        $pdf = Pdf::loadView('laporan.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-Pendapatan-' . date('Y-m-d-his') . '.pdf');
    }
}
