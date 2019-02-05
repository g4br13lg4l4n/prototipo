<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**GET */
    public function index()
    {
        $category = Category::all();
        $category = $category->sortBy('genericCode');
        return $this->showAll($category);
    }
    /**GET */
    public function show(Category $category){
        return $this->showOne($category);
    }
    /**POST */
    public function store(Request $request){
        $_category = new Category();
        $_level = 0;

        $_genericCode = $this->generationCode( $request->input('parent'));
        $request->request->add(['genericCode' => $_genericCode]);
        
        $_level = $this->getLevel( $request->input('genericCode'));
        $request->request->add(['level' => $_level]);

        $rules = [
            'genericCode' => 'required|unique:categories',
            'category' => 'required|max:50',
            'shortName' => 'required|max:20',
            'description' => 'max:150',
            'level' => 'required'
        ];
        $this->validate($request, $rules);      
        $category = Category::create( $request->all() ); 
        return $this->showOne($category);
    }
    
    public function update(Request $request, Category $category){
     
    }
    public function destroy(Category $category){
        
    }
    public function generationCode($parent)
    {
        $_genericCode = "";
        $_children = 0;

        if($parent){
            $_category =  DB::table('categories')
            ->where('genericCode', 'like', ''.$parent.'.%')
            ->get();

            $_children = $_category->count();    
            $_genericCode = ($parent.".".($_children +1) );  
        }else{
            $_category =  DB::table('categories')
                    ->where('genericCode', 'not like', '%.%')
                    ->get();

            $_children = $_category->count();    
            $_genericCode = (string)($_children + 1);
        }
             
        return $_genericCode;
    }

    public function getLevel($genericCode){
        $levels = explode(".", $genericCode);
        return sizeof($levels);
    }
}
