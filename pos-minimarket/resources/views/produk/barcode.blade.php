<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
</head>
<body class="tw-font-sans">
    <table width="100%">
        <tr>
            @foreach($dataproduk as $produk)
                <td class="text-center" style="border:1px solid rgb(105, 104, 104); align-items:center; justify-content:center; text-align:center; padding:0.5rem;">
                    <p>{{$produk->nama_produk}} - Rp. {{format_uang($produk->harga_jual)}}</p>
                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($produk->kode_produk, 'C39')}}" alt="{{$produk->kode_produk}}"
                    width="180"
                    height="60">
                    <br>
                    {{$produk->kode_produk}}
                </td>
                @if($no++ % 3 == 0) 
                    </tr><tr>
                        {{-- JIKA BARCODE SUDAH 3 MAKA AKAN NEWLINE KABAWAH --}}
                @endif
            @endforeach
        </tr>
    </table>
</body>
</html>