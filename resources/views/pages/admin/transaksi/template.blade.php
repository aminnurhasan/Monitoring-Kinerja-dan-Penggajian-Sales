<!DOCTYPE html>
<html>
<head>
    <style>
        table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        }
        
        th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
        }
        
        th {
        background-color: #f2f2f2;
        font-weight: bold;
        }
        
        tr:hover {
        background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">{{ $title }}</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Sales</th>
                <th>Nama Toko</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->toko }}</td>
                <td>{{ $data->quantity }} Packs</td>
                <td>Rp. {{ number_format($data->total) }}</td>
                <td>{{ $data->waktu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <ul>
        @foreach ($transaksi as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul> --}}
</body>
</html>