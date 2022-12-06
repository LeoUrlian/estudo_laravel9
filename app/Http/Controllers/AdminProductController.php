<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
  public function index()
  {
    $products = Product::all();
    return view('admin.admin_products', compact('products'));
  }

  public function show()
  {
  }

  // Mostrar página de criar
  public function create()
  {
    return view('admin.admin_products_create');
  }

  // Recebe requisição para criar POST
  public function store(ProductStoreRequest $request)
  {
    $input = $request->validated();
    $input['slug'] = Str::slug($input['name']);

    if (!empty($input['cover']) && $input['cover']->isValid()) {
      $file = $input['cover'];
      $path = $file->store('products');
      $input['cover'] = $path;
    }

    Product::create($input);

    return Redirect::route('admin.products');
  }

  // Mostrar página de editar
  public function edit(Product $product)
  {
    return view('admin.admin_products_edit', [
      'product' => $product
    ]);
  }

  // Recebe requisição para dar update PUT
  public function update(Product $product, Request $request)
  {
    $input = $request->validate([
      'name' => 'string|required',
      'price' => 'string|required',
      'stock' => 'string|nullable',
      'cover' => 'file|nullable',
      'description' => 'string|nullable'
    ]);

    if (!empty($input['cover']) && $input['cover']->isValid()) {
      Storage::delete($product->cover ?? '');
      $file = $input['cover'];
      $path = $file->store('products');
      $input['cover'] = $path;
    }

    $product->fill($input);
    $product->save();

    return Redirect::route('admin.products');
  }

  public function destroy(Product $product)
  {
    $product->delete();
    Storage::url($product->cover ?? '');

    return Redirect::route('admin.products');
  }

  public function destroyImage(Product $product)
  {
    Storage::url($product->cover ?? '');
    $product->cover = null;
    $product->save();

    return Redirect::back();
  }
}
