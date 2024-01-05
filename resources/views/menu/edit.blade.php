@extends('layouts.template')

@section('content')
    <form action="{{ route('menu.update', $menu['id']) }}" method="post" class="card bg-light mt-5 p-5">
        {{-- sebagai token akses database --}}
        @csrf
        {{-- menimpa agar method post menjadi patch --}}
        @method('PATCH')
        {{-- jika terjadi error, tampilkan bagian errornya --}}
        @if ($errors->any())
            <ul class="alert alert-danger p-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama Obat :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $menu['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">Harga Obat :</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="price" name="price" value="{{ $menu['price'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>

@endsection
