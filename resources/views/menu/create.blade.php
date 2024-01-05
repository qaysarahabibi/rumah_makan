@extends('layouts.template')

@section('content')
    @if ($errors->any())
        <ul class="alert alert-danger p-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    
    <form action="{{ route('menu.store') }}" method="POST" class="card p-5">
        @csrf
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama Makanan :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">Harga Makanan :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="price" name="price">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah data</button>
    </form>
@endsection
