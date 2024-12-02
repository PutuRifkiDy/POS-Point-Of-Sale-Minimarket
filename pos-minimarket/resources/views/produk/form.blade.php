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
                        <label for="nama_produk" class="col-md-3 control-label tw-font-medium tw-text-3xl">Produk</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_produk" class="col-md-3 control-label tw-font-medium tw-text-3xl">Kode Produk</label>
                        <div class="col-md-9">
                            <input type="text" name="kode_produk" id="kode_produk" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-3 control-label tw-font-medium tw-text-3xl">Kategori</label>
                        <div class="col-md-9">
                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merk" class="col-md-3 control-label tw-font-medium tw-text-3xl">Merk</label>
                        <div class="col-md-9">
                            <input type="text" name="merk" id="merk" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_beli" class="col-md-3 control-label tw-font-medium tw-text-3xl">Harga Beli</label>
                        <div class="col-md-9">
                            <input type="number" name="harga_beli" id="harga_beli" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_jual" class="col-md-3 control-label tw-font-medium tw-text-3xl">Harga Jual</label>
                        <div class="col-md-9">
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control rounded-[5px] text-3xl" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-md-3 control-label tw-font-medium tw-text-3xl">Diskon</label>
                        <div class="col-md-9">
                            <input type="number" name="diskon" id="diskon" class="form-control rounded-[5px] text-3xl" value="0">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stok" class="col-md-3 control-label tw-font-medium tw-text-3xl">Stok</label>
                        <div class="col-md-9">
                            <input type="number" name="stok" id="stok" class="form-control rounded-[5px] text-3xl" value="0">
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
