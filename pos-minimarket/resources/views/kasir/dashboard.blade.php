@extends('layouts.master');

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Dashboard</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body text-center">
                    <h1>Selamat Datang</h1>
                    <h2>Anda Login Sebagai Kasir</h2>
                    <br>
                    <a href="{{route('transaksi.baru')}}" class="btn btn-success btn-lg">Transaksi Baru</a>
                </div>
            </div>
        </div>
    </div>
@endsection
