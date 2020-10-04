<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(){

        $this->middleware(function ($request, $next) {
            if (Auth::user()->is_customer) {
                return redirect()->route('product.list');
            }
                return $next($request);
            });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Product::all();
        return Inertia::render('products', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all();

        $img = '';

        if ($request->hasfile('image')) {

            $name = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/uploads/products/', $name);
            $img = '/uploads/products/' . $name;
        }

        $data['image'] = $img;

        $data['status'] = true;


        Product::create($data);

        return redirect()->back()
            ->with('message', 'Product Created Successfully.');
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
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {

        try {

            if ($id != '') {

                $data = $request->all();

                if ($request->hasfile('image')) {
                    $img = '';
                    $name = time() . '.' . $request->file('image')->getClientOriginalExtension();
                    $request->file('image')->move(public_path() . '/uploads/products/', $name);
                    $img = '/uploads/products/' . $name;

                    $data['image'] = $img;
                } else {
                    unset($data['image']);
                }

                Product::find($id)->update($data);

                return redirect()->back()
                    ->with('message', 'Product Updated Successfully.');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Product::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

    public function status(Request $request, $id)
    {
        if (isset($id)) {

            $product = Product::find($id);

            if ($request->status) {
                $product->update(['status' => false]);
            } else {
                $product->update(['status' => true]);
            }

            return redirect()->back();
        }
    }
}
