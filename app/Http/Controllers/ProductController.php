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
                            ->select('P.title','P.description','PV.variant AS variend_one','PVT.variant AS variend_two','PVP.price','PVP.stock')

                            ->leftJoin('product_variant_prices AS PVP',function($join){
                                $join->on('PVP.product_id','=','P.id');
                            })
                            ->leftJoin('product_variants AS PV',function($join){
                                $join->on('PV.id','=','PVP.product_variant_one');
                            })
                            ->leftJoin('product_variants AS PVT',function($join){
                                $join->on('PVT.id','=','PVP.product_variant_two');
                            })
                            ->get()
                            ->groupBy('P.title')
                            ->groupBy('P.description');

                            dd($data);

        $product_info = DB::table('products')->get();

        $data = [];

        foreach($product_info AS $key => $value){

            $data[$key]= DB::table('product_variant_prices AS PVP')
                                ->select('PV.variant AS variend_one','PVT.variant AS variend_two','PVP.price','PVP.stock','PVP.*')
                                    ->join('product_variants AS PV',function($join){
                                        $join->on('PV.id','=','PVP.product_variant_one');
                                    })
                                    ->join('product_variants AS PVT',function($join){
                                        $join->on('PVT.id','=','PVP.product_variant_two');
                                    })
                                    ->where('PVP.product_id',$value->id)
                                    ->get();

        }


        $details = [
            'product_inf' => $product_info,
            'varient_info' => $data,
        ];

// echo "<pre>";
// print_r($data);
// echo "</pre>";
            // dd($data);

        return view('products.index',compact('details'));
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
