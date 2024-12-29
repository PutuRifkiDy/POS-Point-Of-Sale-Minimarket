<div class="modal fade" tabindex="-1" id="modal-form" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            @method('POST')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title tw-font-semibold tw-text-4xl">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 control-label tw-font-medium tw-text-3xl">Nama</label>
                        <div class="col-md-10">
                            <input type="text" name="name" id="name" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 control-label tw-font-medium tw-text-3xl">Email</label>
                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-md-2 control-label tw-font-medium tw-text-3xl">Level</label>
                        <div class="col-md-10">
                            <select name="level" id="level" class="form-control rounded-[5px] text-3xl" required autofocus>
                                <option value="0">Karyawan</option>
                                <option value="1">Admin Gudang</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-2 control-label tw-font-medium tw-text-3xl">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="password" id="password" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-2 control-label tw-font-medium tw-text-3xl">Konfirmasi Password</label>
                        <div class="col-md-10">
                            <input type="password_confirmation" name="password_confirmation" id="password_confirmation" class="form-control rounded-[5px] text-3xl" required data-match="#password" autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-flat btn-primary">Simpan</button>
                    <button class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div><!-- /.modal-content -->
            
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
