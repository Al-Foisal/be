<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCollection;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCollectionController extends Controller
{
    public function productCollection() {
        $product_collection = ProductCollection::orderBy('id', 'DESC')->get();

        return view('backend.product_collection.product-collection', compact('product_collection'));
    }

    public function createProductCollection() {
        $subcategories = Subcategory::all();

        return view('backend.product_collection.create-product-collection', compact('subcategories'));
    }

    public function storeProductCollection(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|unique:product_collections',
            'product_collection' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if (count($request->product_collection) != 3) {
            return redirect()->back()->withToastSuccess('Please select only 3 (Three) items!');
        }

        ProductCollection::create([
            'name'               => $request->name,
            'product_collection' => implode(',', $request->product_collection),
        ]);

        return redirect()->back()->withToastSuccess('New product collection added successfully!!');
    }

    public function editProductCollection(ProductCollection $product_collection) {
        $subcategories = Subcategory::all();

        return view('backend.product_collection.edit-product-collection', compact('subcategories','product_collection'));
    }

    public function updateProductCollection(Request $request, ProductCollection $coll) {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|unique:product_collections,name,'.$coll->id,
            'product_collection' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if (count($request->product_collection) != 3) {
            return redirect()->back()->withToastSuccess('Please select only 3 (Three) items!');
        }

        $coll->update([
            'name'               => $request->name,
            'product_collection' => implode(',', $request->product_collection),
        ]);

        return redirect()->route('admin.productCollection')->withToastSuccess('Product collection updated successfully!!');
    }

    public function deleteProductCollection(Request $request, ProductCollection $coll) {
        $coll->delete();

        return redirect()->route('admin.productCollection')->withToastSuccess('Product collection deleted successfully!!');
    }

}

