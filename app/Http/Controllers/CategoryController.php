<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{



    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();
        
        return view('backend/createCat', ['categories' => $categories]);
    }


    public function all()
    {
        $categories = Category::all();
        // return $categories;
        return view('frontend/categories', ['categories' => $categories]);
    }



    function createCat(Request $req){
        $req->validate([
            'name' => 'required'
        ]);

       

        $category = new Category();
        $category->name = $req->name;
        $category->parent_id = $req->parent_id;
        
        $category->save();


        return redirect('/admin/createCat')->with('success', 'Category created successfully!');
    }






}
