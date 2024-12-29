@extends('layouts.master')

@section('title')
    Edit Profil
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Edit Profil</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <form action="{{route('user.update_profil')}}" method="post" class="form-profil" data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="alert alert-info alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-check"></i> Perubahan Berhasil disimpan
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control" id="name" required autofocus value="{{$profil->name}}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="foto" class="col-lg-2 col-lg-offset-1 control-label">Profil</label>
                            <div class="col-lg-4">
                                <input type="file" name="foto" class="form-control" id="foto"
                                onchange="preview('.tampil-foto', this.files[0])">
                                <span class="help-block with-errors"></span>
                                <br>
                                <div class="tampil-foto">
                                    <img src="{{ url($profil->foto ?? '/') }}" width="200"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old_password" class="col-md-2 col-lg-offset-1 control-label tw-font-medium tw-text-3xl">Password Lama</label>
                            <div class="col-lg-6">
                                <input type="password" name="old_password" id="old_password" class="form-control rounded-[5px] text-3xl" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-lg-offset-1 control-label tw-font-medium tw-text-3xl">Password</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" id="password" class="form-control rounded-[5px] text-3xl" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-2 col-lg-offset-1 control-label tw-font-medium tw-text-3xl">Konfirmasi Password</label>
                            <div class="col-lg-6">
                                <input type="password_confirmation" name="password_confirmation" id="password_confirmation" class="form-control rounded-[5px] text-3xl" data-match="#password" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button class="btn btnn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endsection

@push('scripts')
    <script>
        $(function(){
            $('#old_password').on('keyup', function(){
                if($(this).val() != ""){
                    $('#password').attr('required', true);
                } else {
                    $('#password, #password_confirmation').attr('required', false);
                }
            });
            $('.form-profil').validator().on('submit', function(e){
                if(!e.preventDefault()){
                    $.ajax({
                        url: $('.form-profil').attr('action'),
                        type: $('.form-profil').attr('method'),
                        data: new FormData($('.form-profil')[0]),
                        async: false,
                        processData: false,
                        contentType: false
                    })
                    .done(response => {
                        window.location.reload();
                        $('[name=name]').val(response.name);
                        $('.tampil-foto').html(`<img src="{{ url('/') }}${response.foto}" width="200"> `);
                        $('.alert').fadeIn();
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Data berhasil disimpan.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        setTimeout(() => {
                            $('.alert').fadeOut();
                        }, 300);
                    })
                    .fail(errors => {
                        if(errors.status == 422){
                            Swal.fire({
                            title: 'Gagal!',
                            text: errors.responseJSON,
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Data gagal disimpan.',
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            });
                        }
                        return;
                    });
                }
            });
        });

    </script>
@endpush