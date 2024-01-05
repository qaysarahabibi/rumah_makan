<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();
            return view('transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Product::all();
        return view('transaction.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required',
            'menus' => 'required',
        ]);

        $menus = array_count_values($request->menus);

        $dataMenus = [];
        foreach($menus as $key => $value) {
            $menu = Product::where('id', $key)->first();
            $arrAssoc = [
                "id" => $key,
                "name_menu" => $menu['name'],
                "price" => $menu['price'],
                "qty" => $value,
                
                "price_after_qty" => $value * (int)$menu['price'],
            ];
            
            array_push($dataMenus, $arrAssoc);
        }

        $totalPrice = 0;
        foreach ($dataMenus as $formatArray) {
            $totalPrice += (int)$formatArray['price_after_qty'];
        }

        $ppn = $totalPrice * 0.1;
        $priceAll = $totalPrice + $ppn;
        Transaction::create([
            'nama_customer' => $request->nama_customer,
            'menus' => $dataMenus,
            'total_price' => $priceAll,
        ]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data Transaksi!');
    }

    public function search(Request $request)
    {
        $searchDate = $request->get('search');
        $transaction = Transaction::whereDate('created_at', $searchDate)->simplePaginate(5);
        return view('transaction.index', compact('transaction'));    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
