<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Member</title>
    <style>
        .box {
            position: relative;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px; /* Jarak antar kolom */
        }
        .card{
            width: 85.60mm;
 
        }
        .logo {
            position: absolute;
            top: 3pt;
            right: 0pt;
            font-size: 16pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #fff !important;
        }
        .logo p {
            text-align: right;
            margin-right: 16pt;
        }
        .logo img {
            position: absolute;
            margin-top: -5pt;
            width: 40px;
            height: 40px;
            right: 16pt;
        }
        .nama {
            position: absolute;
            top: 95pt;
            right: 16pt;
            font-size: 12pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #fff !important;
        }
        .telepon {
            position: absolute;
            margin-top: 80pt;
            right: 16pt;
            color: #fff;
        }
        .barcode {
            position: absolute;
            top: 50pt;
            left: .860rem;
            border: 1px solid #fff;
            padding: .5px;
            background: #fff;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <section style="border: 1px solid #fff">
        <table width="100%">
            @foreach($datamember as $key => $data)
            <tr>
                @foreach($data as $item)
                    <td class="text-center" width="50%">
                        <div class="box">
                            <img src="{{public_path('img/member.png')}}" alt="card" class="card">
                            <div class="logo">
                                <p>{{config('app.name')}}</p>
                                {{-- <img src="{{public_path('img/logoToko.png')}}" alt="logo" class="logo"> --}}
                            </div>
                            <div class="nama">
                                {{$item->nama}}
                            </div>
                            <div class="telepon">
                                {{$item->telepon}}
                            </div>
                            <div class="barcode text-left">
                                <img src="data:image/png;base64, {{DNS2D::getBarcodePNG("$item->kode_member", 'QRCODE')}}" alt="qrcode" width="45" height="45">
                            </div>
                        </div>

                    </td>
                    @if(count($datamember) == 1)
                    <tf class="text-center" style="width: 50%;"></tf>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </table>
    </section>
</body>
</html>