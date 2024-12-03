<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Kategori;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        return view("produk.index", compact("kategori"));
    }

    public function data(){
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
        ->select('produk.*', 'nama_kategori')
        ->get();
        
        return datatables()
        ->of($produk)
        ->addIndexColumn()
        ->addColumn('select_all', function($produk){
            return '<input type="checkbox" name="id_produk[]" value="'.$produk->id_produk.'">';
        })
        ->addColumn('kode_produk', function($produk){
            return '<span class="label label-success">'.$produk->kode_produk.'</span>';
        })
        ->addColumn('harga_beli', function($produk){
            return format_uang($produk->harga_beli);
        })
        ->addColumn('harga_jual', function($produk){
            return format_uang($produk->harga_jual);
        })
        ->addColumn('stok', function($produk){
            return format_uang($produk->stok);
        })
        ->addColumn('aksi', function ($produk){
                return '<button type="button" onclick="editForm(`'. route('produk.update', $produk->id_produk) .'`)" class="btn btn-info btn-flat"><i class="fa fa-edit"></i></button> <button type="button" onclick="deleteData(`'.route('produk.destroy', $produk->id_produk).'`)" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
            })->rawColumns(['aksi', 'kode_produk', 'select_all'])->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $produk = Produk::create($request->all());

        return response()->json('Data Berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $produk = Produk::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $produk = Produk::find($id);
        $produk->update($request->all());

        return response()->json('Data Berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $produk = Produk::find($id);
        $produk->delete();

        return response()->json(null, 204);
    }

    public function deleteSelected(Request $request) 
    {
        foreach ($request->id_produk as $id) {
           $produk = Produk::find($id);
           $produk->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach($request->id_produk as $id){
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }

        $no = 1;
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('produk.pdf');

    }
    
}
