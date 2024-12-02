@extends('layouts.master');

@section('title')
    Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Produk</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addForm('{{ route('produk.store') }}')"
                        class="btn btn-success xs btn-flat">
                        <i class="fa fa-plus-circle"></i>
                        Tambah
                    </button>
                    <button onclick="deleteSelected('{{ route('produk.delete_selected') }}')"
                        class="btn btn-danger xs btn-flat">
                        <i class="fa fa-trash"></i>
                        Hapus
                    </button>
                    <button onclick="cetakBarcode('{{ route('produk.cetak_barcode') }}')"
                        class="btn btn-info xs btn-flat">
                        <i class="fa fa-barcode"></i>
                        Cetak Barcode
                    </button>
                </div>
                <div class="box-body table-rensponsive">
                    <form action="" method="post" class="form-produk">
                        @csrf
                        <table class="table table-stiped table-bordered tw-text-2xl">
                            <thead>
                                <th>
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>
    
                            </tbody>
                        </table>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @includeIf('produk.form')
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
                    url: '{{ route('produk.data') }}',
                },
                columns: [
                    {
                        data: 'select_all'
                    },
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
                        data: 'nama_kategori'
                    },
                    {
                        data: 'merk'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'stok'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            // Fungsi untuk meng-handle saat form disubmit.
            $('#modal-form').validator().on('submit', function(e) {
                // Jika form valid dan tidak ada error.
                if (!e.preventDefault()) {
                    // Lakukan pengiriman data menggunakan AJAX.
                    $.ajax({
                            url: $('#modal-form form').attr('action'), // Ambil URL action dari form.
                            type: 'POST', // Kirim data menggunakan metode POST.
                            data: $('#modal-form form')
                            .serialize() // Ambil semua data dalam form dan kirimkan.
                        })
                        .done((response) => {
                            // Jika berhasil, tutup modal dan reload tabel.
                            $('#modal-form').modal('hide');
                            table.ajax.reload(); // Reload data pada tabel.
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Data berhasil disimpan.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        })
                        .fail((errors) => {
                            // Jika gagal, tampilkan pesan error.
                            const notyf = new Notyf();
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Data gagal disimpan.',
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            });
                            return;
                        });
                }
            });

            $('[name=select_all]').on('click', function(){
                $(':checkbox').prop('checked', this.checked);
            });
        });

        // Fungsi untuk menampilkan modal dengan form kosong atau form yang sudah terisi.
        function addForm(url) {
            $('#modal-form').modal('show'); // Tampilkan modal.
            $('#modal-form .modal-title').text('Tambah Produk'); // Ganti judul modal.

            $('#modal-form form')[0].reset(); // Reset form jika ada data lama.
            $('#modal-form form').attr('action', url); // Atur URL action form.
            $('#modal-form [name=_method]').val('post'); // Tentukan method untuk form (POST).
            $('#modal-form [name=nama_produk]').focus(); // Fokuskan ke input kategori.
        }

        // Fungsi untuk menampilkan modal dengan form kosong atau form yang sudah terisi.
        function editForm(url) {
            $('#modal-form').modal('show'); // Tampilkan modal.
            $('#modal-form .modal-title').text('Edit Produk'); // Ganti judul modal.

            $('#modal-form form')[0].reset(); // Reset form jika ada data lama.
            $('#modal-form form').attr('action', url); // Atur URL action form.
            $('#modal-form [name=_method]').val('put'); // Tentukan method untuk form (PUT).
            $('#modal-form [name=nama_produk]').focus(); // Fokuskan ke input kategori.

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_produk]').val(response.nama_produk);
                    $('#modal-form [name=kode_produk]').val(response.kode_produk);
                    $('#modal-form [name=id_kategori]').val(response.id_kategori);
                    $('#modal-form [name=merk]').val(response.merk);
                    $('#modal-form [name=harga_beli]').val(response.harga_beli);
                    $('#modal-form [name=harga_jual]').val(response.harga_jual);
                    $('#modal-form [name=diskon]').val(response.diskon);
                    $('#modal-form [name=stok]').val(response.stok);
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

    function deleteSelected(url) {
    // Menampilkan SweetAlert2 konfirmasi sebelum menghapus data terpilih
        if ($('input:checked').length > 0) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Semua data yang dipilih akan dihapus dan tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request untuk menghapus data yang dipilih menggunakan AJAX
                    $.post(url, $('.form-produk').serialize())
                    .done((response) => {
                        // Reload tabel setelah berhasil menghapus
                        table.ajax.reload();
                        // Tampilkan notifikasi sukses
                        Swal.fire(
                            'Terhapus!',
                            'Data yang dipilih telah berhasil dihapus.',
                            'success'
                        );
                    })
                    .fail((errors) => {
                        // Jika gagal, tampilkan pesan error
                        Swal.fire(
                            'Gagal!',
                            'Data gagal dihapus.',
                            'error'
                        );
                    });
                }
            });
        } else {
            // Jika tidak ada data yang dipilih
            Swal.fire(
                'Pilih Data!',
                'Pilih Data yang Ingin Dihapus.',
                'error'
            );
            return;
        }
    }
    function cetakBarcode(url) {
    // Cek apakah minimal 3 data terpilih
    if ($('input:checked').length < 3) {
        Swal.fire(
            'Pilih Minimal 3 Data!',
            'Pilih minimal 3 data untuk dicetak!',
            'warning'
        );
        return;
    } else {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Semua data yang dipilih akan dicetak barcodenya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Cetak',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user konfirmasi, kirim form untuk mencetak barcode
                $('.form-produk').attr('action', url)
                                  .attr('target', '_blank')  // Form akan dibuka di tab baru
                                  .submit();  // Kirim form
            }
        });
    }
}


    </script>
@endpush
