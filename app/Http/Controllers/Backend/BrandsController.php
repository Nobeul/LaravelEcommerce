<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Brand;
use Image;
use File;


class brandsController extends Controller
{
   public function index(){
   	$brands = Brand::orderBy('id','desc')->get();
   	return view('admin.pages.brands.index',compact('brands'));
   }

   public function create(){
   	
   	return view('admin.pages.brands.create');
   }

   public function store(Request $request){

   	$request->validate([
            'name'         => 'required|max:150',
            'image'			  => 'nullable|image'
            ],
            [
            	'name.required'	=> 'please provide brand name',
            	'image.image' 	=> 'please insert a valid image with .jpeg/.jpg/.png/.gif'
            ]
    );

    	$brand = new Brand();
    	$brand->name = $request->name;
    	$brand->description = $request->description;
    	
    	$brand->save();


    	if ($request->hasFile('image')) {
          //insert that image
          $image = $request->file('image');
          $img = time() . '.'. $image->getClientOriginalExtension();
          $location = public_path('images/brands/' .$img);
          Image::make($image)->save($location);
        
          $brand->image = $img;
          $brand->save();
      }
    	
    	session()->flash('success', 'A new brand has been added successfully');
    	return redirect()->route('admin.brands');
   }


   public function edit($id)
   {
   	$brand = Brand::find($id);

	   	if(!is_null($brand)){
	   	return view('admin.pages.brands.edit',compact('brand'));
	   }else{
	   	return redirect()->route('admin.brands');
	   }
   }

   

   public function update(Request $request, $id){

   	$request->validate([
            'name'         => 'required|max:150',
            'image'			  => 'nullable|image',
            ],
            [
            	'name.required'	=> 'please provide brand name',
            	'image.image' 	=> 'please insert a valid image with .jpeg/.jpg/.png/.gif'
            ]
    );

    	$brand = Brand::find($id);
    	$brand->name = $request->name;
    	$brand->description = $request->description;
    	$brand->save();


    	if ($request->hasFile('image')) {
          
    	  if (File::exists('images/brands/'.$brand->image)) {
    	  	File::delete('images/brands/'.$brand->image);
    	  }
          //insert that image
          $image = $request->file('image');
          $img = time() . '.'. $image->getClientOriginalExtension();
          $location = public_path('images/brands/' .$img);
          Image::make($image)->save($location);
        
          $brand->image = $img;
          $brand->save();
      }
    	
    	session()->flash('success', 'brand has been updated successfully');
    	return redirect()->route('admin.brands');
   }

   public function delete($id){
    	$brand = Brand::find($id);

    	if (!is_null($brand)) {
    		
    		//Delete brand image
    		if (File::exists('images/brands/'.$brand->image)) {
    	  	File::delete('images/brands/'.$brand->image);
    	  	}
    		
    		$brand->delete();
    	}
    	session()->flash('success', 'Brand has been deleted successfully');
    	return back();
    }

}
