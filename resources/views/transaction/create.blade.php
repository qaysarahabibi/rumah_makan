@extends('layouts.template')

@section('content')
    <form action="{{ route('transaction.store') }}" class="card p-4 mt-5" method="POST">
        @csrf
        @if (($errors)->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
        <div class="mb-3">
            <div class="mb-3 d-flex align-items-center">
                <label for="nama_customer" class="form-label col-2" style="width: 11%">Nama Pembeli : </label>
                <input type="text" name="nama_customer" id="nama_customer" class="form-control" style="width:89%">
            </div>
            <div class="mb-3 d-flex align-items-center">
                <label for="menus" class="form-label col-2" style="width: 11%">Makanan :</label>
                <select name="menus[]" id="menus" class="form-control" style="width: 89%">
                    <option selected hidden disabled>Pesanan 1</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu['id'] }}">{{ $menu['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div id="wrap-select"></div>
            <p class="text-primary" style="margin-left: 11%; margin-top: 10px; cursor: pointer;" onclick="addSelect()">+Tambah Pesanan</p>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endsection

@push('script')
    <script>
        let no = 2;
        function addSelect() {  
            let el = `<div class="mb-3 d-flex align-items-center mb-3">
                <label for="nama_customer" class="form-label col-2" style="width: 11%"></label>
                <select name="menus[]" id="menus" class="form-control" style="width: 89%" >
                    <option selected hidden disabled>Pesanan ${no}</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu['id'] }}">{{ $menu['name'] }}</option>
                    @endforeach
                </select>
            </div>`;
            $("#wrap-select").append(el);
            no++;
        }
    </script>
@endpush
