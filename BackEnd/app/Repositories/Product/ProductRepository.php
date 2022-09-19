<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Specifications;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
            $products = $products->search($search);
        }
        if (!empty($request->category_id)) {
        $products->nameCate($request)
            ->filterPrice(request(['startPrice', 'endPrice']))
            ->filterDate(request(['start_date', 'end_date']))
            ->status($request)
            ;
        }

        $products->filterPrice(request(['startPrice', 'endPrice']));
        $products->filterDate(request(['start_date', 'end_date']));
        $products->status($request);



        return $products->orderBy('id', 'DESC')->paginate(5);
    }
    public function create($data)
    {
        // dd($data->category_id);
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
            if (!empty($data['image'])) {
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
            $specification = new Specifications();
            $specification->cpu = $data['cpu'];
            $specification->ram = $data['ram'];
            $specification->rom = $data['rom'];
            $specification->display = $data['display'];
            $specification->battery = $data['battery'];
            $specification->color = $data['color'];
            $product->specification->update($specification->toArray());

            //create product_images
            if ($data['file_names']) {
                ProductImage::where('product_id', '=', $product->id)->delete();
                foreach ($data['file_names'] as $file_detail) {
                    // File::delete($product->file_names()->file_name);
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $product->file_names()->saveMany([
                        new ProductImage([
                            'product_id' => $product->id,
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
