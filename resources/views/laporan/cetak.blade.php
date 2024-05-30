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
    <h4 class='tengah'>Rentang tanggal {{ $tanggal }}</h4>
    <p>Tanggal cetak : {{ date('d/m/Y') }}</p>
    <table>
        <tr class="tengah">
            <th width="5%">#</th>
            <th width="20%">Invoice</th>
            <th width="20%">Klien</th>
            <th width="20%">Sesi</th>
            <th width="25%">Informasi</th>
            <th width="10%">Status</th>
        </tr>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td class="tengah">{{ $loop->iteration }}</td>    
                    <td class="tengah">{{ $item->id }}</td>            
                    <td>{{ $item->klien->nama_klien }}</td>       
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
