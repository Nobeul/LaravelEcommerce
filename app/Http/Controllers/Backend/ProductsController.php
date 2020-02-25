<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

use App\Product;
use App\ProductImage;
use Image;

class ProductsController extends Controller
{
    
    public function index()
    {
        return view('admin.pages.index');
    }
    public function product_create()
    {
        return view('admin.pages.product.create');
    }
    public function product_edit($id)
    {
        $product = Product::find($id);
        return view('admin.pages.product.edit')->with('product', $product);
    }
    public function manage_products()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.pages.product.index')->with('products', $products);
    }
    public function product_store(Request $request)
    {
        $request->validate([
            'title'         => 'required|max:150',
            'description'     => 'required',
            'price'             => 'required|numeric',
            'quantity'             => 'required|numeric',
            'category_id'             => 'required|numeric',
            'brand_id'             => 'required|numeric',
        ]);
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        
        $product->slug = Str::slug($request->title);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->save();
        //ProductImage Model insert image
        // if ($request->hasFile('product_image')) {
        //   //insert that image
        //   $image = $request->file('product_image');
        //   $img = time() . '.'. $image->getClientOriginalExtension();
        //   $location = public_path('images/products/' .$img);
        //   Image::make($image)->save($location);
        //
        //   $product_image = new ProductImage;
        //   $product_image->product_id = $product->id;
        //   $product_image->image = $img;
        //   $product_image->save();
        // }
        if (count($request->product_image) > 0) {
            foreach ($request->product_image as $image) {
                //insert that image
                //$image = $request->file('product_image');
                        // $img = time() . '.'. $image->getClientOriginalExtension();
                        // $location = public_path('images/products/' .$img);
                        // Image::make($image)->save($location);
            $imageName = time().'.'.$request->image->extension(); 
            $product->image = $request->image->move(public_path('images/brands/'), $imageName);

             

                
                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product_image->image = $imageName;
                $product_image->save();
            }
        }
        return redirect()->route('admin.product.create');
    }

    public function product_update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|max:150',
            'description'     => 'required',
            'price'             => 'required|numeric',
            'quantity'             => 'required|numeric',
            'category_id'             => 'required|numeric',
            'brand_id'                   => 'required|numeric',
        ]);
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();
        return redirect()->route('admin.products');
    }


    public function product_delete($id){
    	$product = Product::find($id);

    	if (!is_null($product)) {
    		$product->delete();
    	}
    	session()->flash('success', 'Product has been deleted successfully');
    	return back();
    }

    
}


