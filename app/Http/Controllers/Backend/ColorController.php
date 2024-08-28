<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $colors = Color::withCount('products')->get();

        return view('backend.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.color.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'color_code'   => 'required|unique:colors',
            'color_code.*' => 'required',
            'color'        => 'required|unique:colors',
            'color.*'      => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        foreach ($request->input('color') as $key => $f) {
            Color::create(['color_code' => $request->color_code[$key], 'color' => $request->color[$key]]);
        }

        return redirect()->route('admin.colors.index')->withToastSuccess('Colors Added Successfully!!');
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
    public function edit(Color $color) {
        return view('backend.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color) {
        $validator = Validator::make($request->all(), [
            'color_code' => 'required|unique:colors,color_code,' . $color->id,
            'color' => 'required|unique:colors,color,' . $color->id,
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $color->update($request->all());

        return redirect()->route('admin.colors.index')->withToastSuccess('Colors Updated Successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color) {
        $color->delete();

        return redirect()->route('admin.colors.index')->withToastSuccess('Colors Deleted Successfully!!');

    }

}
