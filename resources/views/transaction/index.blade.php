    @extends('layouts.template')

    @section('content')
    <div class="card">
        <div class="card-body">
        <h1 style="text-align: center"><b>Data Transaksi RM KITA</b></h1>
        <br>
        <div class="container mt-3">
                <form action="{{ route('transaction.search') }}" method="GET">
                    <div class="input-group">
                        <input type="date" name="search" id="search" value="{{ request('search') }}"
                            class="form-control">
                        <button type="submit" class="btn btn-primary">Cari Data</button>
                        @if (request('search'))
                            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Clear</a>
                        @endif
                </form>
            </div>
        </div>
        <br>

        <table class="table-bordered w-100 table mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($transaction as $item)
                <TR>
                    <td>{{ $no++ }}</td>
                        @php
                            // set lokasi waktu berdasarkan penamaan dan jam indonesia
                            setLocale(LC_ALL, 'IND');
                        @endphp
                        {{-- carbon / package bawaan laravel untuk memanipulasi format tanggal/waktu --}}
                        <td> {{ Carbon\Carbon::parse($item['created_at'])->formatLocalized('%d %B %Y') }} </td>
                        <td>{{ $item['nama_customer'] }}</td>
                        <td>
                            <ol>
                                @foreach ($item['menus'] as $product)
                                    <li>{{ $product['name_menu'] }}
                                        <i>(Rp.{{ number_format($product['price_after_qty'], 0, '.', ',') }})</i>
                                       <b> ×{{ $product['qty'] }}</b>
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                        <td>Rp. {{ number_format($item['total_price'], 0, '.', ',') }} </td>
                    </TR>
                @endforeach
            </tbody>
        </table>
        <div class="justify-content-end d-flex">
            <a href="{{ route('transaction.create') }}" class="btn btn-dark ml-2">Pesanan Baru</a>
        </div>
        </div>
            </div>
            </div>
    @endsection
