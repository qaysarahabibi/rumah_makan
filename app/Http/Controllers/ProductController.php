<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $menu = Product::all();
            return ResponseFormatter::success(200,'Data Berhasil Didapatkan', $menu);
        } catch (\Throwable $th) {
            return ResponseFormatter::error(400, $th->getMessage());
        }
            return view('menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
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
            'name' => 'required|min:3',
            'price' => 'required|min:3',
        ]);
            
        Product::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data Menu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Product::find($id);
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
        ]);
        Product::where('id', $id)->update
        ([
                'name' => $request->name,
                'price' => $request->price,
            ]);

        return redirect()->route("menu.index")->with('success', 'Berhasil mengubah data Menu!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data obat!');
    }

}
