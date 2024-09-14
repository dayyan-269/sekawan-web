@extends('template')
@section('title', 'Admin | Jadwal Kendaraan')
@section('content')
<x-container.admin>
    <x-table title="Daftar Jadwal Kendaraan">
        <a href="#" type="button" class="btn btn-sm btn-success">Insert</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Kendaraan</th>
                    <th>Jenis Kendaraan</th>
                    <th>Jenis Kepemilikan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </x-table>
</x-container.admin>
@endsection