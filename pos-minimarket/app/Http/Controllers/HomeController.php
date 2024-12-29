<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index(){
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get()->count();
        $produk = Produk::orderBy('id_produk', 'desc')->get()->count();
        $member = Member::orderBy('id_member', 'desc')->get()->count();
        $supplier = Supplier::orderBy('id_supplier', 'desc')->get()->count();
        return view('dashboard.index', compact('kategori', 'produk', 'member', 'supplier'));
    }
}
