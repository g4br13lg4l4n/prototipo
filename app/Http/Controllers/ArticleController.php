<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    
    public function index()
    {
        $article = Article::all();
        return $this->showAll($article);
    }

       
    public function show(Article $article)
    {
        return $this->showOne($article);
    }

    public function store(Request $request)
    {
        $rules = [
            'internalCode' => 'required|unique:articles', 
            'name' => 'required|unique:articles',
            'shortName' => 'nullable',
            'description' => 'required',
            'stock' => 'required|regex:/^^[0-9]*$/',
            'purchasePrice' => 'nullable',
            'salePrice' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/',
        ];
      
        $this->validate($request, $rules);
        $article = Article::create( $request->all() );     
        return  $this->showOne($article);
    }
    public function update(Request $request, Article $article)
    {
        $article->fill($request->only([ 
            'internalCode',
            'name',
            'stock',
            'purchasePrice',
            'salePrice',
        ]));

        if ($article->isClean()) { // is la instancia no ha cambiado o no se ha actualizado ningún valor
            return $this->errorResponse('Debe especificar al menos un valor diferente', 422);
        }
       
            $rules = [
                'internalCode' => 'required|unique:articles', 
                'name' => 'required|unique:articles',
                'shortName' => 'nullable',
                'stock' => 'required|regex:/^^[0-9]*$/',
                'purchasePrice' => 'nullable',
                'salePrice' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/',
            ];
        

        $this->validate($request, $rules);

        $article->save();
        return $this->showOne($article);
    }
    public function destroy(Article $article)
    {
        $article->delete();
        return $this->showOne($article);
    }
}
