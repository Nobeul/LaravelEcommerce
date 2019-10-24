<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;

class PagesController extends Controller
{
    public function index(){
    	$products = Product::orderby('id','desc')->paginate(9);
    	return view('pages.index',compact('products'));
    }


    public function contact(){
    	return view('pages.contact');
    }

    public function search(Request $request){
        $search = $request->search;
        $products = Product::orwhere('title','like','%'.$search.'%')
        ->orwhere('description','like','%'.$search.'%')
        ->orwhere('slug','like','%'.$search.'%')
        ->orderby('id','desc')
        ->paginate(9);
        return view('pages.products.search',compact('search','products'));
    }
}
