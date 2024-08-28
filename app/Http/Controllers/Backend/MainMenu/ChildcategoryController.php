<?php

namespace App\Http\Controllers\Backend\MainMenu;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ChildcategoryController extends Controller
{
    public function childcategory() {
        $childcategories = Childcategory::with('subcategory', 'subcategory.category')->get();

        return view('backend.main_menu.childcategory.index', compact('childcategories'));
    }

    public function createChildcategory() {
        $categories = Category::where('status', 1)->get();

        return view('backend.main_menu.childcategory.create', compact('categories'));
    }

    public function storechildcategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:childcategories',
            'image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/main_menu/childcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Childcategory::create([
            'name'           => $request->name,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'status'         => 1,
            'image'          => $final_name1,
            'details'        => $request->details,
        ]);

        return redirect()->route('admin.childcategory')->withToastSuccess('Childcategory added successfully!!');
    }

    public function editChildcategory($id) {
        $childcategory = Childcategory::with('subcategory', 'subcategory.category')->where('id', $id)->first();
        $categories    = Category::where('status', 1)->get();

        return view('backend.main_menu.childcategory.edit', compact('childcategory', 'categories'));
    }

    public function updateChildcategory(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:childcategories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $childcategory = Childcategory::where('id', $id)->first();

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($childcategory->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/main_menu/childcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $childcategory->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $childcategory->update([
            'name'           => $request->name,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'details'        => $request->details,
        ]);

        return redirect()->route('admin.childcategory')->withToastSuccess('Childcategory updated successfully!!');
    }

    public function activeChildcategory(Request $request, $id) {
        $childcategory = Childcategory::where('id', $id)->first();

        $childcategory->status = 1;
        $childcategory->save();

        return redirect()->route('admin.childcategory')->withToastSuccess('Childcategory activated successfully!!');
    }

    public function inactiveChildcategory(Request $request, $id) {
        $childcategory = Childcategory::where('id', $id)->first();

        $childcategory->status = 0;
        $childcategory->save();

        return redirect()->route('admin.childcategory')->withToastSuccess('Childcategory inactivated successfully!!');
    }

    public function deleteChildcategory(Request $request, $id) {
        $childcategory = Childcategory::where('id', $id)->first();

        $childcategory->delete();

        return redirect()->route('admin.childcategory')->withToastSuccess('Childcategory deleted successfully!!');
    }

}

