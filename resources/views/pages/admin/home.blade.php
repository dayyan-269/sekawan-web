@extends('template')
@section('title', 'Admin | Home')
@section('content')
<x-container.admin>
    <div class="d-flex flex-column">
        <h3>Overview</h3>
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">Pemesanan Kendaraan</h5>
                <hr>
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
                </tbody>
            </table>
        </x-table>
    </div>
</x-container.admin>
@endSection