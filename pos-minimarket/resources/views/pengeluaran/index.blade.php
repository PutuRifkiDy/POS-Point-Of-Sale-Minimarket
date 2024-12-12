@extends('layouts.master');

@section('title')
   Daftar Pengeluaran
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Pengeluaran</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12 w-full">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addForm('{{ route('pengeluaran.store') }}')"
                        class="btn btn-success xs btn-flat flex gap-10 justify-center items-center">
                        <i class="fa fa-plus-circle"></i>
                        Tambah
                    </button>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-stiped table-bordered text-2xl">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @includeIf('pengeluaran.form')
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
                    url: '{{ route('pengeluaran.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'deskripsi'
                    },
                    {
                        data: 'nominal'
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
        });

        // Fungsi untuk menampilkan modal dengan form kosong atau form yang sudah terisi.
        function addForm(url) {
            $('#modal-form').modal('show'); // Tampilkan modal.
            $('#modal-form .modal-title').text('Tambah Pengeluaran'); // Ganti judul modal.

            $('#modal-form form')[0].reset(); // Reset form jika ada data lama.
            $('#modal-form form').attr('action', url); // Atur URL action form.
            $('#modal-form [name=_method]').val('post'); // Tentukan method untuk form (POST).
            $('#modal-form [name=deskripsi]').focus(); // Fokuskan ke input Deskripsi.
        }

        // Fungsi untuk menampilkan modal dengan form kosong atau form yang sudah terisi.
        function editForm(url) {
            $('#modal-form').modal('show'); // Tampilkan modal.
            $('#modal-form .modal-title').text('Edit Pengeluaran'); // Ganti judul modal.

            $('#modal-form form')[0].reset(); // Reset form jika ada data lama.
            $('#modal-form form').attr('action', url); // Atur URL action form.
            $('#modal-form [name=_method]').val('put'); // Tentukan method untuk form (PUT).
            $('#modal-form [name=deskripsi]').focus(); // Fokuskan ke input kategori.

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=deskripsi]').val(response.deskripsi);
                    $('#modal-form [name=nominal]').val(response.nominal);
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
