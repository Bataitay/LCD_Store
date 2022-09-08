<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Specifications;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    function getModel()
    {
        return Product::class;
    }
    public function all($request)
    {
        $products = $this->model->where('created_at', '>', now()->subMonths(3));
        if (!empty($request->search)) {
        $search = $request->search;
            $products = $products->where('name', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%')
                ->orWhere('sale_price', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('quantity', 'like', '%' . $search . '%');
        }
        return $products->orderBy('id', 'DESC')->paginate(10);
    }
    public function create($data)
    {
        try {
            //create product
            $product = $this->model;
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->sale_price = $data['sale_price'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->description = $data['description'];
            $product->created_by = Auth::user()->id;
            if ($data['image']) {
                $file = $data['image'];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = 'storage/' . $file->store('/products', 'public');
                $product->image = $path;
            }
            $product->save();

            //create specifications
            $specifications = new Specifications();
            $specifications->product_id = $product->id;
            $specifications->cpu = $data['cpu'];
            $specifications->ram = $data['ram'];
            $specifications->rom = $data['rom'];
            $specifications->display = $data['display'];
            $specifications->battery = $data['battery'];
            $specifications->color = $data['color'];
            $specifications->save();

            //create product_images
            if ($data['file_names']) {
                foreach ($data['file_names'] as $file_detail) {
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $product->file_names()->saveMany([
                        new ProductImage([
                            'file_name' => $detail_path,
                        ]),
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function update($id, $data)
    {
        try {
            //create product
            $product = $this->model->find($id);
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->sale_price = $data['sale_price'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->description = $data['description'];
            $product->created_by = Auth::user()->id;
            if ($data['image']) {
                $file = $data['image'];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = 'storage/' . $file->store('/products', 'public');
                $product->image = $path;
            }
            $product->save();
            //create specifications
            $specifications = new Specifications();
            $specifications->product_id = $product->id;
            $specifications->cpu = $data['cpu'];
            $specifications->ram = $data['ram'];
            $specifications->rom = $data['rom'];
            $specifications->display = $data['display'];
            $specifications->battery = $data['battery'];
            $specifications->color = $data['color'];
            $specifications->save();

            //create product_images
            if ($data['file_names']) {
                foreach ($data['file_names'] as $file_detail) {
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $product->file_names()->saveMany([
                        new ProductImage([
                            'file_name' => $detail_path,
                        ]),
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function delete($id)
    {
        $product = $this->model->find($id);
        try {
            $product->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function getTrashed()
    {
        $query = $this->model->onlyTrashed();
        $query->orderBy('id', 'desc');
        $product = $query->paginate(5);
        return $product;
    }
    public function restore($id)
    {
        $product = $this->model->withTrashed()->findOrFail($id);
        $product->restore();
        return $product;
    }
    public function force_destroy($id)
    {
        $product = $this->model->onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return $product;
    }
}
