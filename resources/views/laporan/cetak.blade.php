<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <style type="text/css">
        body{
        font-family: sans-serif;
        }
        table{
        margin: 20px auto;
        border-collapse: collapse;
        }
        table th,
        table td{
        border: 1px solid #3c3c3c;
        padding: 3px 8px;
        }
        .tengah{
            text-align: center;
        }
    </style>
    <h2 class='tengah'>{{ $title }}</h2>
    <p>SIPIRU <br />
        Tanggal cetak : {{ date('d/m/Y') }}</p>
    <table>
        <tr class="tengah">
            <th>#</th>
            <th>Invoice</th>
            <th>Klien</th>
            <th>Sesi</th>
            <th>Informasi</th>
            <th>Status</th>
        </tr>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td class="tengah">{{ $loop->iteration }}</td>    
                    <td>{{ $item->id }}</td>            
                    <td class="tengah">{{ $item->klien->nama_klien }}</td>       
                    <td class="tengah">{{ $item->jadwal_aula->nama_sesi }}</td>       
                    <td>Hal : {{ $item->keperluan }} <br /> Tgl : {{ date('d/m/Y', strtotime($item->tanggal)) }}</td>       
                    <td class="tengah">{{ $item->status_peminjaman }}</td>       
                </tr>    
            @endforeach
        </tbody>
    </table>
    <br />
</body>
</html>
<script>
    print()
</script>
