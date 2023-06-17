<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Requests\AddColorRequest;
use App\Http\Requests\UpdateColorRequest;
use Illuminate\Support\Facades\Session;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    public function store(AddColorRequest $request)
    {
        Color::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        Session::flash('message', 'Color Add Successfully');
        return redirect(route('admin.colors.index'));
    }

    public function update(UpdateColorRequest $request, $colorId)
    {
        $color = Color::findOrFail($colorId);
        $color->update([
            'name' => $request->name,
            'code' => $request->code,

        ]);
        Session::flash('message', 'Color Updated Successfully');
        return redirect(route('admin.colors.index'));
    }

    public function destroy($colorId)
    {
        Color::findOrFail($colorId)->delete();
        Session::flash('message', 'Color deleted Successfully');
        return redirect(route('admin.colors.index'));
    }
}
