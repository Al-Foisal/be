<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Childcategory;
use App\Models\Subcategory;

class GeneralController extends Controller {
    public function getSubcategory($id) {
        $subcategory = Subcategory::where('category_id', $id)->get();

        return json_encode($subcategory);
    }

    public function getChildcategory($category_id, $subcategory_id) {
        $childcategory = Childcategory::where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->get();

        return json_encode($childcategory);
    }
}
