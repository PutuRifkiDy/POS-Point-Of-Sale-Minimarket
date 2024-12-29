<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanPembelianController extends Controller
{
    //
    public function index()
    {
        $tanggal_awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggal_akhir = date('Y-m-d');
        return view('laporan_pembelian.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function getData($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $pembelian = 0;

        $total_pembelian = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $pembelian_detail = PembelianDetail::where('created_at', 'LIKE', "%$tanggal%")->get();
            $pembelian = PembelianDetail::where('created_at', 'LIKE', "%$tanggal%")->sum('subtotal');

            $total_pembelian += $pembelian;

            foreach ($pembelian_detail as $detail) {
                $row = [];
                $row['DT_RowIndex'] = $no++;
                $row['tanggal'] = tanggal_indonesia($tanggal, false);
                $row['nama_produk'] = $detail->produk->nama_produk;
                $row['harga_beli'] = format_uang($detail->harga_beli);
                $row['jumlah'] = format_uang($detail->jumlah);
                $row['subtotal'] = format_uang($detail->subtotal);
                $data[] = $row;
            }
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'nama_produk' => '',
            'harga_beli' => '',
            'jumlah' => 'Total pembelian',
            'subtotal' => format_uang($total_pembelian),
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

        return view('laporan_pembelian.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function exportPDF($awal, $akhir){
        $data = $this->getData($awal, $akhir);
        $pdf = Pdf::loadView('laporan_pembelian.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-Pembelian-' . date('Y-m-d-his') . '.pdf');
    }
}
