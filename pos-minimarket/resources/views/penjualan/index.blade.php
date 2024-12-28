@extends('layouts.master');

@section('title')
   Daftar Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Penjualan</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12 w-full">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-stiped table-bordered text-2xl table-penjualan">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Kode Member</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th>Kasir</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @includeIf('penjualan.detail')
@endsection
@push('scripts')
    <script>
        let table, table1;
        $(function() {
            // Inisialisasi DataTable untuk menampilkan tabel yang bisa di-sort dan di-filter.
            table = $('.table-penjualan').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('penjualan.data') }}',
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
                        data: 'kode_member'
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'kasir'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            table1 = $('.table-detail').DataTable({
                processing: true,
                bsort: false,
                dom: 'Brt',
                columns: [
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                ]
            })
        });


        function showDetail(url){
            $('#modal-detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        // Fungsi untuk menampilkan modal dengan form kosong atau form yang sudah terisi.
        function editForm(url) {
            $('#modal-form').modal('show'); // Tampilkan modal.
            $('#modal-form .modal-title').text('Edit Supplier'); // Ganti judul modal.

            $('#modal-form form')[0].reset(); // Reset form jika ada data lama.
            $('#modal-form form').attr('action', url); // Atur URL action form.
            $('#modal-form [name=_method]').val('put'); // Tentukan method untuk form (PUT).
            $('#modal-form [name=nama]').focus(); // Fokuskan ke input kategori.

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=alamat]').val(response.alamat);
                    $('#modal-form [name=telepon]').val(response.telepon);
                })
                .fail((response) => {
                    // Jika gagal, tampilkan pesan error.
                    const notyf = new Notyf();
                    notyf.error('Tidak dapat menampilkan data');
                    return
                })
        }

        function deleteData(url) {
        // Menampilkan SweetAlert2 konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim request untuk menghapus data menggunakan AJAX
                $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    // Reload tabel setelah berhasil menghapus
                    table.ajax.reload();
                    // Tampilkan notifikasi sukses
                    Swal.fire(
                        'Terhapus!',
                        'Data telah berhasil dihapus.',
                        'success'
                    );
                })
                .fail((response) => {
                    // Jika gagal, tampilkan pesan error
                    Swal.fire(
                        'Gagal!',
                        'Data gagal dihapus.',
                        'error'
                    );
                });
            }
        });
    }

    </script>
@endpush
