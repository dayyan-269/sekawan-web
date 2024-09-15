@extends('template')
@section('title', 'Admin | Akun Pengguna')
@section('content')
<x-container.admin>
    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-insert" class="btn btn-sm btn-success">Insert</button>
    <x-table title="Daftar Akun Admin">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <span class="badge badge-success bg-success">Aktif</span>
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
        </table>
    </x-table>

    <x-table title="Daftar Akun Supervisor">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supervisor as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <span class="badge badge-success bg-success">Aktif</span>
                    </td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="{{ '#super-update-' . $item->id }}"
                            class="btn btn-sm btn-info px-3">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="{{ '#super-delete-' . $item->id }}"
                            class="btn btn-sm btn-danger px-3">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
</x-container.admin>

<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.account.insert') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Akun</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                      <label for="name">Nama Pengguna</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nama Pengguna" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <label for="role">Role</label>
                      <select class="form-control" name="role" id="role" required>
                        <option>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="supervisor">Supervisor</option>
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

@foreach ($admin as $item)
    <div class="modal fade" id="{{ 'modal-update-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.master.account.update', ['id' => $item->id, 'role' => 'admin']) }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Akun</h5>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Pengguna</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Pengguna"
                                value="{{ $item->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $item->email }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="{{ 'modal-delete-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.master.account.delete', ['id' => $item->id, 'role' => 'admin']) }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus akun</h5>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        Apakah anda yakin ingin menghapus data akun ini?
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

@foreach ($supervisor as $item)
<div class="modal fade" id="{{ 'super-update-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.account.update', ['id' => $item->id, 'role' => 'supervisor']) }}"
                method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Update Akun</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Pengguna</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Pengguna"
                            value="{{ $item->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                            value="{{ $item->email }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="{{ 'super-delete-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.account.delete', ['id' => $item->id, 'role' => 'supervisor']) }}"
                method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus akun</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    Apakah anda yakin ingin menghapus data akun ini?
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