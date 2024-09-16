<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export</title>
    <style>
        table, tr, th, td {
            border: 1px solid black;
        }

        th, td {
            width: 120px;
        }

        th {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Kendaraan</th>
                <th>Jenis Kendaraan</th>
                <th>Admin</th>
                <th>Tanggal Order</th>
                <th>Tanggal Selesai</th>
                <th>Supervisor 1</th>
                <th>Supervisor 2</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->vehicle->no_kendaraan }}</td>
                <td>{{ Str::title($item->vehicle->jenis_kendaraan) }}</td>
                <td>{{ $item->admin->name }}</td>
                <td>{{ $item->tanggal_order }}</td>
                <td>{{ $item->tanggal_selesai ?? '-' }}</td>
                @if ($item->approvals)
                @foreach ($item->approvals as $supervisorList)
                <td>{{ $supervisorList->supervisor->name }}</td>
                @endforeach
                @else
                <td>-</td>
                <td>-</td>
                @endif
                <td>
                    {{ Str::title($item->status) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>