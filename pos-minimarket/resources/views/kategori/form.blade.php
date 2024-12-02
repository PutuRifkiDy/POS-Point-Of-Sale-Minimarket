<div class="modal fade" tabindex="-1" id="modal-form" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
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
                        <label for="nama_kategori" class="col-md-2 control-label tw-font-medium tw-text-3xl">Kategori</label>
                        <div class="col-md-10">
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control rounded-[5px] text-3xl" required autofocus>
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
