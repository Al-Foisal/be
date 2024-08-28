<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $brands = Brand::withCount('products')->paginate(5);

        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.brand.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'image'         => 'required',
            'image.*'       => 'required|mimes:jpg,png,webp',
            'brand'         => 'required',
            'brand.*'       => 'required',
            'brand_title'   => 'required',
            'brand_title.*' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $files = [];

        if ($request->hasfile('image')) {

            foreach ($request->file('image') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('images/brand/'), $name);
                $files[] = 'images/brand/' . $name;
            }

        }

        foreach ($files as $key => $f) {
            $brand              = new Brand();
            $brand->image       = $f;
            $brand->brand       = $request->brand[$key];
            $brand->brand_title = $request->brand_title[$key];
            $brand->save();
        }

        return redirect()->route('admin.brands.index')->withToastSuccess('brands Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand) {
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand) {
        $validator = Validator::make($request->all(), [
            'image'       => 'nullable|mimes:jpg,png,webp',
            'brand'       => 'required|unique:brands,brand,' . $brand->id,
            'brand_title' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($brand->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/brand/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $brand->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $brand->update([
            'brand'       => $request->brand,
            'brand_title' => $request->brand_title,
        ]);

        return redirect()->route('admin.brands.index')->withToastSuccess('brands Updated Successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand) {
        $image_path = public_path($brand->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->withToastSuccess('brands Deleted Successfully!!');

    }

    public function activeInMall(Request $request, Brand $mall) {
        $mall->mall = 1;
        $mall->save();

        return redirect()->back()->withToastSuccess('This brand added to mall successfully!!');
    }

    public function inactiveInMall(Request $request, Brand $mall) {
        $mall->mall = 0;
        $mall->save();

        return redirect()->back()->withToastSuccess('This brand remove from mall successfully!!');
    }

}

