<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #205295;
            color: white;
        }

        #customers td {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 align="center">Data Transaksi</h2>

    <table id="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemesan</th>
                <th>Tanggal</th>
                <th>Pembayaran</th>
                <th>Status</th>
                <th>Jumlah Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nom = 1;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td>{{ $nom++ }}</td>
                    <td>{{ Str::limit($row->user->name, 20) }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>
                        @if ($row->pembayaran == 0)
                            Transfer Bank
                        @elseif ($row->pembayaran == 1)
                            Bayar Langsung
                        @endif
                    </td>
                    <td>
                        @if ($row->status == 1)
                            Belum Bayar
                        @elseif($row->status == 2)
                            Sudah Dibayar
                        @elseif($row->status == 3)
                            Selesai
                        @endif
                    </td>
                    <td>
                        @if ($row->pembayaran == 0)
                            Rp. {{ number_format($row->jumlah_harga + $row->kode) }}
                        @elseif ($row->pembayaran == 1)
                            Rp. {{ number_format($row->jumlah_harga) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
