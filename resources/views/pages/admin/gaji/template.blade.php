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
                <th>Nama</th>
                <th>GaPok</th>
                <th>Insentif</th>
                <th>Bonus</th>
                <th>Denda</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama }}</td>
                <td>Rp. {{ number_format($data->gapok) }}</td>
                <td>Rp. {{ number_format($data->insentif) }}</td>
                <td>Rp. {{ number_format($data->bonus) }}</td>
                <td>Rp. {{ number_format($data->denda) }}</td>
                <td>Rp. {{ number_format($data->total) }}</td>
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