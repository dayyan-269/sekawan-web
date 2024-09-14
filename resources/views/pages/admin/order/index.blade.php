@extends('template')
@section('title', 'Admin | Pengiriman 1')
@section('content')
<x-container.admin>
    <x-table title="Daftar Pengiriman">
        <a href="#" type="button" class="btn btn-sm btn-success">Insert</a>
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
            </tbody>
        </table>
    </x-table>
</x-container.admin>
@endsection