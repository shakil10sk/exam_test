<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $data = DB::table('products AS P')
                            ->select('P.title','P.description','P.created_at','PV.variant AS variend_one','PVT.variant AS variend_two','PVP.price','PVP.stock')
                            // ->select( DB::raw('GROUP_CONCAT(P.title) AS title'),DB::raw('GROUP_CONCAT(P.description) AS description'),'PV.variant AS variend_one','PVT.variant AS variend_two','PVP.price','PVP.stock')

                            ->leftJoin('product_variant_prices AS PVP',function($join){
                                $join->on('PVP.product_id','=','P.id');
                            })
                            ->leftJoin('product_variants AS PV',function($join){
                                $join->on('PV.id','=','PVP.product_variant_one');
                            })
                            ->leftJoin('product_variants AS PVT',function($join){
                                $join->on('PVT.id','=','PVP.product_variant_two');
                            })
                            ->groupBy('P.id')
                            ->paginate(2);
                            // ->groupBy('P.description');

                            // dd($data);

            $variants = DB::table('product_variants')->get();

        return view('products.index',compact('data','variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        dd($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
