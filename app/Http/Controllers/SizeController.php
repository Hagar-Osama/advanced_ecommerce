<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function store(AddSizeRequest $request)
    {
        Size::create([
            'name' => $request->name,
        ]);
        Session::flash('message', 'Size Add Successfully');
        return redirect(route('admin.sizes.index'));
    }

    public function update(UpdateSizeRequest $request, $sizeId)
    {
        $size = Size::findOrFail($sizeId);
        $size->update([
            'name' => $request->name,

        ]);
        Session::flash('message', 'size Updated Successfully');
        return redirect(route('admin.sizes.index'));
    }

    public function destroy($sizeId)
    {
        Size::findOrFail($sizeId)->delete();
        Session::flash('message', 'Size deleted Successfully');
        return redirect(route('admin.sizes.index'));
    }
}
