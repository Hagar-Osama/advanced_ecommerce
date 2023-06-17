<?php

namespace App\Http\Controllers;

use App\Http\Enums\ProductStatusEnum;
use Exception;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Traits\UploadTrait;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    use UploadTrait;
    public function index()
    {
        $products = Product::with(
            'category',
            'brand',
            'sizes',
            'colors',
            'images'
        )->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::whereNull('category_id')->get();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.create', compact(
            'categories',
            'brands',
            'colors',
            'sizes'
        ));
    }

    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = $thumbnail->hashName();
            $this->uploadFiles($thumbnail, 'products/thumbnails/', $thumbnailName);
            $product =  Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'long_description' => $request->long_description,
                'short_description' => $request->short_description,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'code' => $request->code,
                'tags' => $request->tags,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'qty' => $request->qty,
                'thumbnail' => $thumbnailName,
                'hot_deals' =>  $request->input('hot_deals', 'inactive'),
                'special_offers' => $request->input('special_offers', 'inactive'),
                'special_deals' => $request->input('special_deals', 'inactive'),
                'status' => $request->has('status') ? ProductStatusEnum::ACTIVE : ProductStatusEnum::INACTIVE
            ]);
            $product->colors()->attach($request->colors);
            $product->sizes()->attach($request->sizes);
            $images = $request->file('images');
            foreach ($images as $image) {
                $imageName = $image->hashName();
                $this->uploadFiles($image, 'products/images/', $imageName);
                ProductImage::create([
                    'name' => $imageName,
                    'product_id' => $product->id
                ]);
            }
            DB::commit();
            Session::flash('message', 'Product created successfully');
            return redirect()->route('admin.products.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        $categories = Category::whereNull('category_id')->get();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.edit', compact(
            'categories',
            'brands',
            'colors',
            'sizes',
            'product'
        ));
    }



    public function update(UpdateProductRequest $request, int $productId)
    {
        $product = Product::findOrFail($productId);
        // dd($request->all());
        try {
            DB::beginTransaction();
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = $thumbnail->hashName();
                $this->uploadFiles(
                    $thumbnail,
                    'products/thumbnails/',
                    $thumbnailName,
                    'products/thumbnails/' . $product->thumbnail
                );
            }

            $product->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'long_description' => $request->long_description,
                'short_description' => $request->short_description,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'code' => $request->code,
                'tags' => $request->tags,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'qty' => $request->qty,
                'thumbnail' => $thumbnailName ?? $product->thumbnail,
                'hot_deals' => $request->input('hot_deals', 'inactive'),
                'special_offers' => $request->input('special_offers', 'inactive'),
                'special_deals' => $request->input('special_deals', 'inactive'),
                'status' => $request->has('status') ? ProductStatusEnum::ACTIVE : ProductStatusEnum::INACTIVE
            ]);
            $product->colors()->sync($request->colors);
            $product->sizes()->sync($request->sizes);
            // $images = $request->file('images');
            // foreach ($images as $imageId => $image) {
            //     $productImage = ProductImage::findOrFail($imageId);
            //     $imageName = $image->hashName();
            //     $this->uploadFiles(
            //         $image,
            //         'products/images/',
            //         $imageName,
            //         'products/images/' . $productImage->name
            //     );
            //     $productImage->update([
            //         'name' => $imageName,
            //     ]);
            // }
            DB::commit();
            Session::flash('message', 'Product Updated successfully');
            return redirect()->route('admin.products.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function updateImages(Request $request)
    {
        $images = $request->file('images');
        foreach ($images as $imageId => $image) {
            $productImage = ProductImage::findOrFail($imageId);
            $imageName = $image->hashName();
            $this->uploadFiles(
                $image,
                'products/images/',
                $imageName,
                'products/images/' . $productImage->name
            );
            $productImage->update([
                'name' => $imageName,
            ]);
        }
        Session::flash('message', 'Product Image Updated successfully');
        return redirect()->back();
    }

    //     The reason you're passing $image->id in the name attribute of the <input> tag is to associate each uploaded image with its corresponding record in the database. By using the format images[{{$image->id}}], you're creating an associative array where the keys are the image IDs and the values are the uploaded image files.
    // When the form is submitted, the Request object in the updateImages function will receive this associative array of image files. In the updateImages function, you can then use the $imageId (which is the key in the associative array) to find the corresponding ProductImage record and update it with the new image file.

    public function deleteImage($imageId)
    {
        $productImage = ProductImage::findOrFail($imageId);
        $productImage->delete();
        if ($productImage->name) {
            $this->deleteFile('products/images/' . $productImage->name);
        }
        Session::flash('message', 'Product Image Deleted successfully');
        return redirect()->back();
    }

    public function destroy($productId)
    {
        try {
            // DB::beginTransaction();
            $product = Product::findOrFail($productId);
            foreach ($product->images as $image) {
                if ($image->name) {
                    $image->delete();
                    $this->deleteFile('products/images/' . $image->name);
                }
            }
            $product->delete();
            // DB::commit();
            Session::flash('message', 'Product Deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            // DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
