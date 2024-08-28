<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller {
    public function allSlider() {
        $sliders = Slider::all();

        return view('backend.slider.all-slider', compact('sliders'));
    }

    public function createSlider() {
        $categories = Category::all();

        return view('backend.slider.create-slider', compact('categories'));
    }

    public function storeSlider(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'type'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/slider/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Slider::create([
            'image'       => $final_name1,
            'type'        => $request->type,
            'link'        => $request->link,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->withToastSuccess("Slider added!!");

    }

    public function editSlider(Slider $slider) {
        $categories = Category::all();

        return view('backend.slider.edit-slider', compact('slider', 'categories'));
    }

    public function updateSlider(Request $request, Slider $slider) {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'type'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {
                $image_path = public_path($slider->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/slider/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);

                $slider->update(['image' => $final_name1]);
            }

        }

        $slider->update([
            'type'        => $request->type,
            'link'        => $request->link,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.allSlider')->withToastSuccess("Slider added!!");

    }

    public function deleteSlider(Slider $slider) {
        $image_path = public_path($slider->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $slider->delete();

        return redirect()->route('admin.allSlider')->withToastSuccess('Slideer deleted');
    }

}
