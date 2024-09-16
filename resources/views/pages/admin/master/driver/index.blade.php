@extends('template')
@section('title', 'Admin | Pengemudi')
@section('content')
<x-container.admin>
    @error('message')
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{ 'error' }}
    </div>
    @enderror

    <x-table title="Daftar Pengemudi">
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-insert"
            class="btn btn-sm btn-success">Insert</button>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pengemudi</th>
                    <th>Jenis Pegawai</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($driver as $item)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->tipe_pegawai }}</td>
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
            {{ $driver->links() }}
        </table>
    </x-table>
</x-container.admin>

<!-- Modal -->
<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.driver.insert') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengemudi</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Nama Pengemudi</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Pengemudi" required>
                    </div>
                    <div class="form-group">
                        <label for="tipe_pegawai">Tipe Pegawai</label>
                        <select class="form-control" name="tipe_pegawai" id="tipe_pegawai" required>
                            <option>Pilih Tipe Pegawal</option>
                            <option value="pusat">Pusat</option>
                            <option value="cabang">Cabang</option>
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

@foreach ($driver as $item)
<div class="modal fade" id="{{ 'modal-update-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.driver.update', ['id' => $item->id]) }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengemudi</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Pengemudi</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}"
                            placeholder="Nama Pengemudi" required>
                    </div>
                    <div class="form-group">
                        <label for="tipe_pegawai">Tipe Pegawai</label>
                        <select class="form-control" name="tipe_pegawai" id="tipe_pegawai" required>
                            <option>Pilih Tipe Pegawal</option>
                            <option value="pusat" {{ $item->tipe_pegawai == 'pusat' ? 'selected' : '' }}>Pusat</option>
                            <option value="cabang" {{ $item->tipe_pegawai == 'cabang' ? 'selected' : '' }}>Cabang
                            </option>
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
            <form action="{{ route('admin.master.driver.delete', ['id' => $item->id]) }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pengemudi</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    Apakah anda yakin ingin menghapus data pengemudi ini?
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