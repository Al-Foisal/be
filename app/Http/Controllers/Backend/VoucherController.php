<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller {
    public function voucherList() {
        $voucher_list = Voucher::orderBy('id', 'DESC')->get();

        return view('backend.voucher.voucher-list', compact('voucher_list'));
    }

    public function createVoucher() {

        return view('backend.voucher.create-voucher');
    }

    public function storeVoucher(Request $request) {
        $validator = Validator::make($request->all(), [
            'offer_amount'  => 'required|numeric',
            'min_amount'    => 'required|numeric',
            'validity_from' => 'required|after_or_equal:today',
            'validity_to'   => 'required|after_or_equal:today',
            'image'         => 'required|mimes:jpg,png,webp',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/voucher/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Voucher::create([
            'offer_amount'  => $request->offer_amount,
            'min_amount'    => $request->min_amount,
            'validity_from' => $request->validity_from,
            'validity_to'   => $request->validity_to,
            'image'         => $final_name1,
            'external_link' => $request->external_link,
        ]);

        return redirect()->back()->withToastSuccess('New voucher added successfully!!');
    }

    public function editVoucher(Voucher $voucher) {

        return view('backend.voucher.edit-voucher', compact('voucher'));
    }

    public function updateVoucher(Request $request, Voucher $voucher) {
        $validator = Validator::make($request->all(), [
            'offer_amount'  => 'required',
            'min_amount'    => 'required',
            'validity_from' => 'required',
            'validity_to'   => 'required',
            'image'         => 'nullable|mimes:jpg,png',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($voucher->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/voucher/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $voucher->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $voucher->update([
            'offer_amount'  => $request->offer_amount,
            'min_amount'    => $request->min_amount,
            'validity_from' => $request->validity_from,
            'validity_to'   => $request->validity_to,
            'external_link' => $request->external_link,
        ]);

        return redirect()->route('admin.voucherList')->withToastSuccess('Voucher updated successfully!!');
    }

    public function deleteVoucher(Request $request, Voucher $voucher) {
        $image_path = public_path($voucher->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $voucher->delete();

        return redirect()->route('admin.voucherList')->withToastSuccess('Voucher deleted successfully!!');
    }

}
