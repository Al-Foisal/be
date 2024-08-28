<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    public function index() {
        $products = Product::with('images', 'sizes', 'colors', 'category', 'subcategory', 'childcategory')->orderBy('id', 'DESC')->paginate(20);

        return view('backend.product.index', compact('products'));
    }

    public function productStock() {
        $products = Product::where('quantity', '<=', 6)->with('images', 'category')->paginate(20);

        return view('backend.product.stock', compact('products'));
    }

    public function createProduct() {
        $data               = [];
        $data['categories'] = Category::where('status', 1)->get();
        $data['sizes']      = Size::all();
        $data['colors']     = Color::all();
        $data['brands']     = Brand::all();

        return view('backend.product.create', $data);
    }

    public function storeProduct(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'selling'  => 'required',
            'quantity' => 'required',
            'details'  => 'required',
            'image'    => 'required',
            'image.*'  => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if (($request->discount <= 0 || $request->discount === null) && ($request->flash_deal === 1 || $request->low_price === 1 || $request->flash_sale === 1)) {
            return back()->with('toast_error', 'The product must have discount price.')->withInput();
        }

        $product = Product::create([
            'name'             => $request->name,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'brand_id'         => $request->brand_id,
            'status'           => 1,
            'buying'           => $request->buying,
            'selling'          => $request->selling,
            'discount'         => $request->discount,
            'discount_price'   => $request->discount_price,
            'quantity'         => $request->quantity,
            'specification'    => $request->specification,
            'details'          => $request->details,
            'video'          => $request->video,
            'flash_deal'       => $request->flash_deal,
            'low_price'        => $request->low_price,
            'flash_sale'       => $request->flash_sale,
            'fashion'          => $request->fashion,
        ]);

#file insertion area
        $files = [];

        if ($request->hasfile('image')) {

            foreach ($request->file('image') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('images/product/'), $name);
                $files[] = 'images/product/' . $name;
            }

        }

        foreach ($files as $f) {
            ProductImage::create(['product_id' => $product->id, 'image' => $f]);
        }

        $product->sizes()->sync($request->sizes);
        $product->colors()->sync($request->colors);

        return redirect()->back()->withToastSuccess('New product added successfully!!');
    }

    public function editProduct($id) {
        $data               = [];
        $data['product']    = Product::with('category', 'subcategory', 'sizes', 'colors')->where('id', $id)->first();
        $data['categories'] = Category::where('status', 1)->get();
        $data['sizes']      = Size::all();
        $data['colors']     = Color::all();
        $data['brands']     = Brand::all();

        return view('backend.product.edit', $data);
    }

    public function updateProduct(Request $request, $id) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'selling'  => 'required',
            'quantity' => 'required',
            'details'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if (($request->discount <= 0 || $request->discount === null) && ($request->flash_deal === 1 || $request->low_price === 1 || $request->flash_sale === 1)) {
            return redirect()->back()->with('toast_error', 'The product must have discount price.');
        }

        $product = Product::with('images')->where('id', $id)->first();

        $product->update([
            'name'             => $request->name,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'brand_id'         => $request->brand_id,
            'buying'           => $request->buying,
            'selling'          => $request->selling,
            'discount'         => $request->discount,
            'discount_price'   => $request->discount_price,
            'quantity'         => $request->quantity,
            'specification'    => $request->specification,
            'details'          => $request->details,
            'video'          => $request->video,
            'flash_deal'       => $request->flash_deal,
            'low_price'        => $request->low_price,
            'flash_sale'       => $request->flash_sale,
            'fashion'          => $request->fashion,
        ]);

        $product->sizes()->sync($request->sizes);
        $product->colors()->sync($request->colors);

        return redirect()->route('admin.index')->withToastSuccess('Product updated successfully!!');

    }

    public function activeProduct(Request $request, $id) {
        $product = Product::findOrFail($id);

        $product->status = 1;
        $product->save();

        return redirect()->route('admin.index')->withToastSuccess('Product Activated Successfully!!');

    }

    public function inactiveProduct(Request $request, $id) {
        $product = Product::findOrFail($id);

        $product->status = 0;
        $product->save();

        return redirect()->route('admin.index')->withToastSuccess('Product Inactivated Successfully!!');

    }

    public function editProductImage($product_id) {
        $product = Product::findOrFail($product_id);
        $images  = ProductImage::where('product_id', $product_id)->get();

        return view('backend.product.edit-image', compact('images', 'product'));
    }

    public function updateProductImage(Request $request) {
        $this->validate($request, [
            'images'   => 'nullable',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        for ($i = 0; $i < $request->count; $i++) {
            $id            = $request->id[$i];
            $images        = $request->image[$i] ?? null;
            $product_image = ProductImage::findOrFail($id);

            if ($product_image) {

                if ($images != null) {

                    $image_file = $images;

                    if ($image_file) {

                        $image_path = public_path($product_image->image);

                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }

                        $img_gen   = hexdec(uniqid());
                        $image_url = 'images/product/';
                        $image_ext = strtolower($image_file->getClientOriginalExtension());

                        $img_name    = $img_gen . '.' . $image_ext;
                        $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                        $image_file->move($image_url, $img_name);
                        $product_image->update(['image' => $final_name1]);
                    }

                }

            }

        }

        return redirect()->back();

    }

    public function deleteProduct($id) {
        $product = Product::with('images')->where('id', $id)->first();

        foreach ($product->images as $image) {
            $image_path = public_path($image->image);

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $image->delete();
        }

        $product->delete();

        return redirect()->back()->withToastSuccess('Product deleted successfully!!');
    }

}
