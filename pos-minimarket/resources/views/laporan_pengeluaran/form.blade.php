<div class="modal fade" tabindex="-1" id="modal-form" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('laporan.refresh')}}" method="get" class="form-horizontal">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title tw-font-semibold tw-text-4xl">Periode Laporan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tanggal_awal" class="col-md-2 control-label tw-font-medium tw-text-3xl">Tanggal Awal</label>
                        <div class="col-md-10">
                            <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control datepicker rounded-[5px] text-3xl" required autofocus value="{{request('tanggal_awal')}}">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_akhir" class="col-md-2 control-label tw-font-medium tw-text-3xl">Tanggal Akhir</label>
                        <div class="col-md-10">
                            <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control datepicker rounded-[5px] text-3xl" required autofocus value="{{request('tanggal_akhir')}}">
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
