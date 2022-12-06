<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $products = Product::all();
    return view('home', [
      "products" => $products
    ]);
  }

  public function show()
  {
  }

  public function store()
  {
  }

  public function update()
  {
  }

  public function destroy()
  {
  }
}
