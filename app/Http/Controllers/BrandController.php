<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\UploadTrait;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    use UploadTrait;
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(CreateBrandRequest $request)
    {
        // dd($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $this->uploadFiles($image, 'brands', $imageName);
        }
            Brand::create([
                'name' => [
                    'en' => ucfirst($request->name['en']),
                    'ar' => $request->name['ar']
                ],
                'slug' => [
                    'en' => Str::slug($request->slug['en'], '-'),
                    'ar' => $request->slug['ar']
                ],
                'image' => $imageName ?? null
            ]);
        Session::flash('message', 'Brand Add Successfully');
        return redirect(route('admin.brands.index'));
    }

    public function edit($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, $brandId)
    {
        $brand = Brand::findOrFail($brandId);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $this->uploadFiles($image, 'brands', $imageName, 'brands/'. $brand->image);
        }
            $brand->update([
                'name' => [
                    'en' => ucfirst($request->name['en']),
                    'ar' => $request->name['ar']
                ],
                'slug' => [
                    'en' => Str::slug($request->slug['en'], '-'),
                    'ar' => $request->slug['ar']
                ],
                'image' => $imageName ?? $brand->image
            ]);
        Session::flash('message', 'Brand Updated Successfully');
        return redirect(route('admin.brands.index'));
    }

    public function destroy($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        $brand->delete();
        if($brand->image) {
            $this->deleteFile('brands/'. $brand->image);
        }
        Session::flash('message', 'Brand Deleted Successfully');
        return redirect(route('admin.brands.index'));

    }
}
