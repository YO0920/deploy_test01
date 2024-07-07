<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        //get all recipes
        
        $recipes = Recipe::select('recipes.id', 'recipes.title', 'recipes.description', 'recipes.created_at', 'recipes.image', 'users.name')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->orderBy('recipes.created_at', 'desc')
            ->limit(3)
            ->get();
        // dd($recipes);
        
        $popular = Recipe::select('recipes.id', 'recipes.title', 'recipes.description', 'recipes.created_at', 'recipes.image', 'users.name')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->orderBy('recipes.views', 'desc')
            ->limit(2)
            ->get();
            
        // dd($popular);
        
        return view('home', compact('recipes', 'popular'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index(Request $request)
    {
        $filters = $request -> all();
        
        // dd($filters);
        
        
        $query = Recipe::query()->select('recipes.id', 'recipes.title', 'recipes.description', 'recipes.created_at', 'recipes.image', 'users.name')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->orderBy('recipes.created_at', 'desc');
            
        if( !empty($filters) ) {
            //もしカテゴリーが選択されてたら
            if ( !empty($filters['categories']) ) {
                //カテゴリーで絞込選択したカテゴリーIDが含まれているレシピを取得
                $query->whereIn('recipes.category_id', $filters['categories']);
            }
            
            // if ( !empty($filters['categories']) ) {
            //     //カテゴリーで絞込選択したカテゴリーIDが含まれているレシピを取得
            //     $query->where('recipes.category_id', $filters['categories']);
                
                
            //もしカテゴリーが選択されてたら
            if ( !empty($filters['title']) ) {
                //カテゴリーで絞込選択したカテゴリーIDが含まれているレシピを取得
                $query->where('recipes.title','like', '%'.$filters['title'].'%');
            }
            
        }
            
        $recipes = $query->paginate(5);
            
            //   dd($recipes);
            
        $categories = Category::all();
            
        return view('recipes.index', compact('recipes', 'categories', 'filters'));
    } 
    
     
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::with(['ingredients','steps', 'reviews.user', 'user'])
            ->where('recipes.id',$id)
            ->first();
        $recipe_recode = Recipe::find($id);
        $recipe_recode->increment('views'); 
        //リレーションで材料とステップを取得
        // dd($recipe);
        
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(recipe $recipe)
    {
        //
    }
}
