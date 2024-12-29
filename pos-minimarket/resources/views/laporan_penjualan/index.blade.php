@extends('layouts.master');

@section('title')
   Laporan Penjualan {{tanggal_indonesia($tanggal_awal, false)}} s/d {{tanggal_indonesia($tanggal_akhir, false)}}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Laporan Penjualan</li>
@endsection

@push('css')
 <style>
    .text-bold{
        font-weight: bold;
    }
 </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 w-full">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="updatePeriode()"
                        class="btn btn-success xs btn-flat flex gap-10 justify-center items-center">
                        <i class="fa fa-plus-circle"></i>
                        Ubah Periode
                    </button>
                    <a 
                        href="{{route('laporan_penjualan.export_pdf', [$tanggal_awal, $tanggal_akhir])}}" target="_blank"
                        class="btn btn-info xs btn-flat flex gap-10 justify-center items-center">
                        <i class="fa fa-file-excel-o"></i>
                        Export PDF
                    </a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered text-2xl">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Jumlah</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @includeIf('laporan_penjualan.form')
@endsection
@push('scripts')
    <script>
        let table;
        $(function() {
            // Inisialisasi DataTable untuk menampilkan tabel yang bisa di-sort dan di-filter.
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('laporan_penjualan.data', [$tanggal_awal, $tanggal_akhir]) }}',
                    type: 'GET',
                },
                
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'nama_produk',
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'subtotal'
                    },
                ],
                dom: 'Brt',
                bSort: false,
                bPaginate: false,
            });


            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            // Fungsi untuk meng-handle saat form disubmit.

        });

        // Fungsi untuk menampilkan modal dengan form kosong atau form yang sudah terisi.
        function updatePeriode(url) {
            $('#modal-form').modal('show'); // Tampilkan modal.
        }


    </script>
@endpush
