<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanPenjualanController extends Controller
{
    //
    public function index()
    {
        $tanggal_awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggal_akhir = date('Y-m-d');
        return view('laporan_penjualan.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function getData($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $penjualan = 0;

        $total_penjualan = 0;

        while(strtotime($awal) <= strtotime($akhir)){
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));
            
            $penjualan_detail = PenjualanDetail::where('created_at', 'LIKE', "%$tanggal%")->get();
            $penjualan = PenjualanDetail::where('created_at', 'LIKE', "%$tanggal%")->sum('subtotal');

            $total_penjualan += $penjualan;

            foreach ($penjualan_detail as $detail) {
                $row = [];
                $row['DT_RowIndex'] = $no++;
                $row['tanggal'] = tanggal_indonesia($tanggal, false);
                $row['nama_produk'] = $detail->produk->nama_produk;
                $row['harga_jual'] = format_uang($detail->harga_jual);
                $row['jumlah'] = format_uang($detail->jumlah);
                $row['diskon'] = format_uang($detail->diskon);
                $row['subtotal'] = format_uang($detail->subtotal);
                $data[] = $row;
            }
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'nama_produk' => '',
            'harga_jual' => '',
            'jumlah' => '',
            'diskon' => 'Total Penjualan',
            'subtotal' => format_uang($total_penjualan),
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

        return view('laporan_penjualan.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function exportPDF($awal, $akhir){
        $data = $this->getData($awal, $akhir);
        $pdf = Pdf::loadView('laporan_penjualan.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-Penjualan-' . date('Y-m-d-his') . '.pdf');
    }
}
