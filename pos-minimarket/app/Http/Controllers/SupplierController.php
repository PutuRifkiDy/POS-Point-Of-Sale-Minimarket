<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("supplier.index");
    }

    /**
     * Show the form for creating a new resource.
     */

     public function data(){
        $supplier = Supplier::orderBy("id_supplier", "desc")->get();
        return datatables()->of($supplier)->addIndexColumn()->addColumn('aksi', function ($supplier){
            return '<button type="button" onclick="editForm(`'. route('supplier.update', $supplier->id_supplier) .'`)" class="btn btn-info btn-flat"><i class="fa fa-edit"></i></button> <button type="button" onclick="deleteData(`'.route('supplier.destroy', $supplier->id_supplier).'`)" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
        })->rawColumns(['aksi'])->make(true);
     }
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
        $supplier = Supplier::create($request->all());
        return response()->json("Data berhasil dimasukkan", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $supplier = Supplier::find($id);

        return response()->json($supplier);
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
        $supplier = Supplier::find($id);
        $supplier->update($request->all());
        return response()->json('Data Berhasil disimpan', 200);    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $supplier = Supplier::find($id);
        $supplier->delete();

        return response()->json(null, 204);

    }
}
