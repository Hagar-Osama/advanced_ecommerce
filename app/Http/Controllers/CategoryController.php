<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('category_id')->get();
        // $subCategories = Category::whereNotNull('category_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function getChildCategory($category_id)
    {
        $childCategory = Category::where('category_id', $category_id)->get();
        return json_encode($childCategory);

    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => [
                'en' => ucwords($request->name['en']),
                'ar' => $request->name['ar']
            ],
            'slug' => [
                'en' => Str::slug($request->slug['en'], '-'),
                'ar' => $request->slug['ar']
            ],
            'icon' => $request->icon,
            'category_id' => $request->category_id
        ]);
        Session::flash('message', 'Category Add Successfully');
        return redirect(route('admin.categories.index'));
    }
    public function edit($catId)
    {
        $category = Category::findOrFail($catId);
        $categories = Category::whereNull('category_id')->get();
        $subCategories = Category::whereNotNull('category_id')->get();
        return view('admin.categories.edit', compact('category', 'categories', 'subCategories'));
    }

    public function update(UpdateCategoryRequest $request, $catId)
    {
        $category = Category::findOrFail($catId);
        $category->update([
            'name' => [
                'en' => ucwords($request->name['en']),
                'ar' => $request->name['ar']
            ],
            'slug' => [
                'en' => Str::slug($request->slug['en'], '-'),
                'ar' => $request->slug['ar']
            ],
            'icon' => $request->icon,
            'category_id' => $request->category_id

        ]);
        Session::flash('message', 'Category Updated Successfully');
        return redirect(route('admin.categories.index'));

    }

    public function destroy($catId)
    {
        Category::findOrFail($catId)->delete();
        Session::flash('message', 'Category Deleted Successfully');
        return redirect(route('admin.categories.index'));
    }
}
