<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BannerCollection;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BannerCollectionController extends Controller {
    public function bannerCollection() {
        $banner = BannerCollection::find(1);
        $sub    = Subcategory::where('status', 1)->get();

        return view('backend.banner-collection', compact('banner', 'sub'));
    }

    public function storeBannerCollection(Request $request) {
        $validator = Validator::make($request->all(), [
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'banner_collection' => 'required',
            'status'            => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        BannerCollection::updateOrcreate(
            ['id' => 1],
            [
                'banner_collection' => $request->banner_collection,
                'status'            => $request->status,
            ]
        );

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {
                $banner = BannerCollection::where('id', 1)->first()->image ?? '';

                if ($banner) {
                    $image_path = public_path($banner);

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/banner_collection/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                BannerCollection::updateOrcreate(
                    ['id' => 1],
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        return redirect()->back()->withToastSuccess('Banner collection store successfully!!');
    }

    public function activeBannerCollection(Request $request, $id) {
        $banner = BannerCollection::findOrFail($id);

        $banner->status = 1;
        $banner->save();

        return redirect()->route('admin.bannerCollection')->withToastSuccess('Banner Collection Activated Successfully!!');

    }

    public function inactiveBannerCollection(Request $request, $id) {
        $banner = BannerCollection::findOrFail($id);

        $banner->status = 0;
        $banner->save();

        return redirect()->route('admin.bannerCollection')->withToastSuccess('Banner Collection Inactivated Successfully!!');

    }

}
