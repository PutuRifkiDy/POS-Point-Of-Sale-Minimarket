<div class="modal fade" tabindex="-1" id="modal-supplier" aria-labelledby="modal-supplier" role="dialog">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title tw-font-semibold tw-text-4xl">Pilih Supplier</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-supplier">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $key => $item)
                            <tr>
                                <td width="5%">{{$key + 1}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->telepon}}</td>
                                <td>{{$item->alamat}}</td>
                                <td width="15%">
                                    <a href="{{route('pembelian.create', $item->id_supplier)}}" class="btn btn-primary btn-flat py-3">
                                        <i class="fa fa-check-circle"></i>
                                        Pilih
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
