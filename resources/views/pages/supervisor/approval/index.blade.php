@extends('template')
@section('title', 'Supervisor | Pengiriman')
@section('content')
<x-container.admin>
    <x-table title="Daftar Pengiriman">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Kendaraan</th>
                    <th>Jenis Kendaraan</th>
                    <th>Admin</th>
                    <th>Tanggal Order</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Persetujuan</th>
                    <th></th>
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
                        @foreach ($item->approvals as $approve)
                            @if ($approve->supervisor_id == request()->cookie('uid'))
                                @if ($approve->status == 'setuju')
                                <span class="badge badge-success bg-success">Setuju</span>
                                @elseif ($approve->status == 'tidak setuju')
                                <span class="badge badge-danger bg-danger">Tidak Setuju</span>
                                @else
                                <span class="badge badge-warning bg-warning">Menunggu</span>
                                @endif
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="{{ '#modal-status-' . $item->id }}"
                            class="btn btn-sm btn-info px-3">
                            <i class="fa fa-sticky-note"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
</x-container.admin>

@foreach ($order as $item)
<div class="modal fade" id="{{ 'modal-status-' . $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('supervisor.approval.approve', ['orderId' => $item->id]) }}" method="post">
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
                            <option value="setuju" {{ $item->status === 'setuju' ? 'selected' : '' }}>Setujui Peminjaman</option>
                            <option value="tidak setuju" {{ $item->status === 'tidak setuju' ? 'selected' : ''
                                }}>Tidak Setujui Peminjaman</option>
                            <option value="menunggu" {{ $item->status === 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
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
@endforeach
@endsection