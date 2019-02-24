<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleImage;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
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

       // $articleImagen = new ArticleImagen();
       // if($request->hasFile('imagen')){
           // $file = $request->file('imagen');
            // $fileName = time().$file->getClientOriginalName();
            //$file->move(public_path().'/articles/',$fileName);        
        //}

        $rules = [
            'internalCode' => 'required|unique:articles|max:12', 
            'name' => 'required|max:60',
            'shortName' => 'nullable',
            'description' => 'required|max:250',
            'stock' => 'required|regex:/^^[0-9]*$/',
            'purchasePrice' => 'nullable',
            'salePrice' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/',
            'offerPrice' => 'nullable'
        ];
      
        $this->validate($request, $rules);
        $article = Article::create( $request->all() );
        $articleImagen->article_id = $article->id; 

        $articleImagen = ArticleImagen::create( $article );     
        return  $this->showOne($article);
    }
    public function update(Request $request, Article $article)
    {
        $article->fill($request->only([
            'id', 
            'internalCode',
            'name',
            'shortName',
            'stock',
            'purchasePrice',
            'salePrice',
            'offerSale'
        ]));
        $_article = Article::find($article->id);
            
        if($_article->internalCode != $article->internalCode){
            $rules = [
                'internalCode' => 'required|unique:articles|max:12', 
                'name' => 'required|max:60',
                'shortName' => 'nullable',
                'description' => 'required|max:250',
                'stock' => 'required|regex:/^^[0-9]*$/',
                'purchasePrice' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/',
                'salePrice' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/',
                'offerSale' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/'
            ];
        }else{
            $rules = [
                'name' => 'required|max:60',
                'shortName' => 'nullable',
                'description' => 'required|max:250',
                'stock' => 'required|regex:/^^[0-9]*$/',
                'purchasePrice' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/',
                'salePrice' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/',
                'offerSale' => 'nullable|regex:/^\d{0,2}(\.\d{1,2})?/'
            ];
        }
        
        if ($article->isClean()) { 
            return $this->errorResponse('Debe especificar al menos un valor diferente', 422);
        }
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