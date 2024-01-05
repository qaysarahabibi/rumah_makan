@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-body">
<h1 style="text-align: center"><b>Daftar Menu RM KITA</b></h1>
<br>
    <table class="table table-bordered table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Makanan</th>
                <th>Harga</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($menu as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ ucwords($item['name']) }}</td>
                    <td> Rp {{ number_format($item['price'], 0, '.', ',') }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('menu.edit',  $item['id']) }}" class="btn btn-outline-primary me-3"><i class="bx bx-edit-alt"></i></a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $item['id']}}"><i class="bx bx-trash"></i></button>
                    </td>
                </tr>  
                
        <div class="modal fade" id="confirmDeleteModal-{{ $item['id']}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Konfirmasi hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus data ini?
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('menu.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
<br>
<div class="justify-content-end d-flex">
    <a href="{{ route('menu.create') }}" class="btn btn-dark">Tambah Menu</a>
</div>
</div>
</div>
        @endsection
