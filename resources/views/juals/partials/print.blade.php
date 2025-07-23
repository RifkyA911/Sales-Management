<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $jual->No_Faktur }}</title>
</head>

<body>
    <h1>Invoice: {{ $jual->No_Faktur }}</h1>
    <p>Tanggal: {{ $jual->Tgl_Faktur }}</p>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jual->details as $item)
                <tr>
                    <td>{{ $item->barang->Nama_Barang }}</td>
                    <td>{{ $item->Qty }}</td>
                    <td>{{ number_format($item->Harga, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->Jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>
