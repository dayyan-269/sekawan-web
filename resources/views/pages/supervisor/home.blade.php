@extends('template')
@section('title', 'Supervisor | Home')
@section('content')
<x-container.admin>
    <div class="d-flex flex-column">
        <h3>Overview</h3>
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h5 class="card-title">Pemesanan Kendaraan</h5>
                </div>
                <hr>
                <div class="chart">
                    <canvas id="bar-chart" class="chart-canvas" height="100px"></canvas>
                </div>
            </div>
        </div>
        <x-table title="Pemesanan Terakhir">
            <table class="table">
                <thead>
                    <tr>
                        <th>Pengemudi</th>
                        <th>No. Kendaraan</th>
                        <th>Jenis Kendaraan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($order as $item)
                    <tr>
                        <td>{{ Str::title($item->driver->name) }}</td>
                        <td>{{ $item->vehicle->no_kendaraan }}</td>
                        <td>{{ Str::title($item->vehicle->jenis_kendaraan) }}</td>
                        <td>{{ $item->tanggal_order }}</td>
                        <td>
                            @if ($item->status === 'selesai')
                            <span class="badge badge-success bg-success">Selesai</span>
                            @elseif ($item->status === 'batal')
                            <span class="badge badge-danger bg-danger">Batal</span>
                            @elseif ($item->status === 'berlangsung')
                            <span class="badge badge-info bg-info">Berlangsung</span>
                            @else
                            <span class="badge badge-warning bg-warning">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-table>
    </div>
</x-container.admin>
@endsection
@section('script')
<script>
    const label = JSON.parse('<?php echo $monthlyTime ?>');
        const data = JSON.parse('<?php echo $monthlyTotal ?>');

        const canvas = document.querySelector('#bar-chart');
        const chart = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [
                    {
                        label: 'Pengiriman Per Tahun',
                        data: data,
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1,
                    }
                ],
            },
        });
</script>
@endsection