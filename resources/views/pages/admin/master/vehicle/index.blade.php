@extends('template')
@section('title', 'Admin | Kendaraan')
@section('content')
<x-container.admin>
    <x-table title="Daftar Kendaraan">
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-insert"
            class="btn btn-sm btn-success">Insert</button>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Kendaraan</th>
                    <th>Jenis Kendaraan</th>
                    <th>Jenis Kepemilikan</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicle as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->no_kendaraan }}</td>
                        <td>Transport {{ Str::title($item->jenis_kendaraan) }}</td>
                        <td>{{ Str::title($item->kepemilikan) }}</td>
                        <td>
                            @if ($item->status === 'aktif')
                                <span class="badge bg-success">
                                    {{ Str::title($item->status) }}
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    {{ Str::title($item->status) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <button type="button" data-bs-toggle="modal" data-bs-target="{{ '#modal-update-' . $item->id }}"
                                class="btn btn-sm btn-info px-3">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="{{ '#modal-delete-' . $item->id }}"
                                class="btn btn-sm btn-danger px-3">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $vehicle->links() }}
        </table>
    </x-table>
</x-container.admin>

<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.vehicles.insert') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kendaraan</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="no_kendaraan">No. Kendaraan</label>
                        <input type="text" class="form-control" name="no_kendaraan" placeholder="No. Kendaraan" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kendaraan</label>
                        <select class="form-control" name="jenis_kendaraan" required>
                            <option>Pilih Jenis Kendaraan</option>
                            <option value="penumpang">Transport Penumpang</option>
                            <option value="tambang">Transport Tambang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kepemilikan</label>
                        <select class="form-control" name="kepemilikan" required>
                            <option>Pilih Jenis Kepemilikan</option>
                            <option value="sewa">Sewa</option>
                            <option value="dibeli">Dibeli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option>Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($vehicle as $item)
    <div class="modal fade" id="{{ 'modal-update-' .$item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.master.vehicles.update', ['id' => $item->id]) }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kendaraan</h5>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="no_kendaraan">No. Kendaraan</label>
                            <input type="text" class="form-control" name="no_kendaraan" value="{{ $item->no_kendaraan }}" placeholder="No. Kendaraan" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kendaraan</label>
                            <select class="form-control" name="jenis_kendaraan" required>
                                <option>Pilih Jenis Kendaraan</option>
                                <option value="penumpang" {{ $item->jenis_kendaraan === 'penumpang' ? 'selected' : ''  }}>Transport Penumpang</option>
                                <option value="tambang" {{ $item->jenis_kendaraan === 'tambang' ? 'selected' : ''  }}>Transport Tambang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kepemilikan</label>
                            <select class="form-control" name="kepemilikan" required>
                                <option>Pilih Jenis Kepemilikan</option>
                                <option value="sewa" {{ $item->kepemilikan === 'sewa' ? 'selected' : '' }}>Sewa</option>
                                <option value="dibeli" {{ $item->kepemilikan === 'dibeli' ? 'selected' : '' }}>Dibeli</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required>
                                <option>Pilih Status</option>
                                <option value="aktif" {{ $item->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif" {{ $item->status === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="{{ 'modal-delete-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.master.vehicles.delete', ['id' => $item->id]) }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kendaraan</h5>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        Apakah anda yakin ingin menghapus data kendaraan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection