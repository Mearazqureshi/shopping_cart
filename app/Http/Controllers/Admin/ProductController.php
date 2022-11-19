<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Storage;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.products.index');
    }


    public function getProducts()
    {
        $products = Product::where('status', 'active')->get();
        return Datatables::of($products)
                    ->addColumn('action', function ($product) {
                        return '<div class="btn-group">
                                <a href="'. url("admin/products/$product->id/edit").'" class="btn btn-primary" title="edit"><i class="fa fa-edit"></i></a>
                                <a href="'. url("admin/products/$product->id").'" class="btn btn-danger btn-delete-record" title="delete" data-id="$product->id"><i class="far fa-trash-alt"></i></a>  
                        </div>';
                    })
                    ->make(true);
    }


    public function create()
    {
        return view('admin.products.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required',
        ]);

        $product_data = $request->all();

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filenames = [];

            $filename  = time().rand(0,9999999).'.'.$image->getClientOriginalExtension(); 
            $filePath = 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $filename;
            Storage::disk('public')->put($filePath, file_get_contents($image));

            $product_data['image'] = $filename;
        }

        Product::create($product_data);
        return redirect('admin/products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $product = Product::find($id);

        if($product){

            $product_data = $request->all();
            if($request->hasFile('image'))
            {
                $image = $request->file('image');

                $filename  = time().rand(0,9999999).'.'.$image->getClientOriginalExtension(); 
                $filePath = 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $filename;
                Storage::disk('public')->put($filePath, file_get_contents($image));

                $product_data['image'] = $filename;
            }

            $product->update($product_data);  
        }

        return redirect('admin/products')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product)
        {
            $product->delete();
            return redirect('admin/products')->with('success', 'Product deleted successfully!');
        }
        else
        {
            return redirect('admin/products')->with('error', 'No data found!');
        }
    }
}
