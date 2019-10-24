<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Category;
use Image;
use File;


class CategoriesController extends Controller
{
   public function index(){
   	$categories = Category::orderBy('id','desc')->get();
   	return view('admin.pages.categories.index',compact('categories'));
   }

   public function create(){
   	$categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
   	return view('admin.pages.categories.create',compact('categories'));
   }

   public function store(Request $request){

   	$request->validate([
            'name'         => 'required|max:150',
            'image'			  => 'nullable|image',
            ],
            [
            	'name.required'	=> 'please provide category name',
            	'image.image' 	=> 'please insert a valid image with .jpeg/.jpg/.png/.gif'
            ]
    );

    	$category = new Category();
    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->parent_id = $request->parent_id;
    	$category->save();


    	if ($request->hasFile('image')) {
          //insert that image
          $image = $request->file('image');
          $img = time() . '.'. $image->getClientOriginalExtension();
          $location = public_path('images/categories/' .$img);
          Image::make($image)->save($location);
        
          $category->image = $img;
          $category->save();
      }
    	
    	session()->flash('success', 'A new category has been added successfully');
    	return redirect()->route('admin.categories');
   }

   public function edit($id){
   	$categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();

   	$category = Category::find($id);

	   	if (!is_null($category)) {
	   		return view('admin.pages.categories.edit', compact('category','categories'));
	   	}else{
	   		return redirect()->route('admin.categories');
	   	}
   }

   public function update(Request $request, $id){

   	$request->validate([
            'name'         => 'required|max:150',
            'image'			  => 'nullable|image',
            ],
            [
            	'name.required'	=> 'please provide category name',
            	'image.image' 	=> 'please insert a valid image with .jpeg/.jpg/.png/.gif'
            ]
    );

    	$category = Category::find($id);
    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->parent_id = $request->parent_id;
    	$category->save();


    	if ($request->hasFile('image')) {
          
    	  if (File::exists('images/categories/'.$category->image)) {
    	  	File::delete('images/categories/'.$category->image);
    	  }
          //insert that image
          $image = $request->file('image');
          $img = time() . '.'. $image->getClientOriginalExtension();
          $location = public_path('images/categories/' .$img);
          Image::make($image)->save($location);
        
          $category->image = $img;
          $category->save();
      }
    	
    	session()->flash('success', 'Category has been updated successfully');
    	return redirect()->route('admin.categories');
   }

   public function delete($id){
    	$category = Category::find($id);

    	if (!is_null($category)) {
    		//if it is a parent category then delete all it's sub categories
    		if ($category->parent_id==NULL) {
    			$sub_categories = Category::orderBy('name', 'desc')->where('parent_id', $category->id)->get();

    			foreach ($sub_categories as $sub) {
    			 	if (File::exists('images/categories/'.$sub->image)) {
		    	  	File::delete('images/categories/'.$sub->image);
		    	  	}
		    	  	$sub->delete();
    			 } 
    		}
    		//Delete category image
    		if (File::exists('images/categories/'.$category->image)) {
    	  	File::delete('images/categories/'.$category->image);
    	  	}
    		
    		$category->delete();
    	}
    	session()->flash('success', 'Product has been deleted successfully');
    	return back();
    }

}
