@extends('template')
@section('title', 'Admin | Pengiriman')
@section('content')
<x-container.admin>
    <x-table title="Daftar Pengiriman">
        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
            data-bs-target="#modal-insert">Insert</button>
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
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="{{ '#modal-status-' . $item->id }}"
                            class="btn btn-sm btn-info px-3">
                            <i class="fa fa-sticky-note"></i>
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
</x-container.admin>

<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.order.insert') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Pengiriman</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="admin">Admin</label>
                        <input type="text" class="form-control" name="admin_id" id="admin" placeholder="Admin" value="2"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="supir">Supir</label>
                        <select class="form-control" name="driver_id" id="supir">
                            <option>Pilih Supir</option>
                            @foreach ($driver as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kendaraan">Kendaraan</label>
                        <select class="form-control" name="vehicle_id" id="kendaraan">
                            <option>Pilih Kendaraan</option>
                            @foreach ($vehicle as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->jenis_kendaraan }} - {{ $item->no_kendaraan }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bbm">Konsumsi BBM (KM)</label>
                        <input type="number" class="form-control" name="bbm" id="bbm" placeholder="Konsumsi BBM"
                            min="0">
                        <small class="form-text text-muted text-xs">*opsional</small>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_order">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal_order" id="tanggal_order"
                            placeholder="Tanggal" value="{{ date('Y-m-d') }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="supervisor">Supervisor 1</label>
                        <select class="form-control" name="supervisor_id[]" id="supervisor">
                            <option>Pilih Supervisor</option>
                            @foreach ($supervisor as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supervisor">Supervisor 2</label>
                        <select class="form-control" name="supervisor_id[]" id="supervisor">
                            <option>Pilih Supervisor</option>
                            @foreach ($supervisor as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
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

@foreach ($order as $item)
<div class="modal fade" id="{{ 'modal-status-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.order.update', ['id' => $item->id]) }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Pengiriman</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="status">Status Pengiriman</label>
                      <select class="form-control" name="status" id="status">
                        <option>Pilih Status Pengiriman</option>
                        <option value="selesai" {{ $item->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="berlangsung" {{ $item->status === 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="menunggu" {{ $item->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="batal" {{ $item->status === 'batal' ? 'selected' : '' }}>Batal</option>
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="{{ 'modal-delete-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.order.delete', ['id' => $item->id]) }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pengiriman</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    Apakah anda yakin ingin menghapus data pengiriman ini?
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