<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $data = array();
        $pengeluaran = 0;

        $total_pengeluaran = 0;

    }
}
