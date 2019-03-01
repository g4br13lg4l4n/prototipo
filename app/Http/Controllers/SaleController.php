<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SaleDetail;
use App\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class SaleController extends ApiController
{

   public function __construct()
    {
        //$this->middleware('client.credentials')->only(['index', 'show']);
        //$this->middleware('auth:api')->except(['index', 'show']);
    }
    public function index()
    {
        $sale = Sale::with('salesDetails')->get();
        return $this->showAll($sale);
    }

    public function show(Sale $sale)
    {
        return $this->showOne($sale);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->request->add(['folio' => (DB::table('sales')->max('folio') + 1)]);
        $request->request->add(['saleDate' =>  Carbon::now()->toDateTimeString()]);
        $request->request->add(['previousAmount' =>  collect($request->salesDetails)->sum('amount')]);
        $request->request->add(['tax' => 0]);
        $request->request->add(['amount' =>  ($request->previosuAmount + $request->tax)]);
        $request->request->add(['saleStatus' => 'Pendiente']);
        $request->request->add(['shippingStatus' => 'En Proceso']);
        $request->request->add(['client_id' => 1]);
        $rules = [
            'folio' => 'required|unique:sales',
            'previousAmount' => 'required|regex:/^\d{0,2}(\.\d{1,2})?/',
            'tax' => 'required|regex:/^\d{0,2}(\.\d{1,2})?/',
            'amount' => 'required|regex:/^\d{0,2}(\.\d{1,2})?/',
            'saleStatus' => 'required',
            'shippingStatus' => 'required'
        ];
        $this->validate($request, $rules);     
        $sale = Sale::create( $request->all() ); 

        /** obtiene los detalles y los manda a guardar */
        if( sizeof($request->salesDetails) > 0){
           $saleDetail = new SaleDetail();
           foreach($request->salesDetails as $detalle){
                $article = Article::find($detalle["article_id"]);
                $rules = [
                    'quantity' => 'required|min:1|numeric',
                    'unitPrice' => 'required',
                    'amount' => 'required|regex:/^\d{0,2}(\.\d{1,2})?/',
                    'sale_id' => 'required',
                    'article_id' => 'required'
                ];
                $saleDetail->quantity = $detalle["quantity"];
                $saleDetail->unitPrice = $article->salePrice;
                $saleDetail->amount = ($saleDetail->unitPrice * $saleDetail->quantity);
                $saleDetail->sale_id = $sale->id;
               // $saleDetail->article_id = $detalle["article_id"];
                Validator::make($saleDetail->toArray(),$rules)->validate();
                $saleDetail->save();
           }
        }
        DB::commit();

        return $this->showOne($sale);
    }

    public function update(Request $request, Sale $sale)
    {
        
    }

    public function destroy(Sale $sale)
    {
        //
    }
}
