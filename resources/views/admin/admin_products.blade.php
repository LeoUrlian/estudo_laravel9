@extends('layouts.default')
@section('content')

<section class="text-gray-600">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
      <div class="flex items-center justify-between mb-2">
        <h1 class="text-2xl font-medium title-font mb-2 text-gray-900">Produtos</h1>
        <a href="{{route('admin.products.create')}}"
          class="flex ml-auto text-white bg-indigo-500 border-0 py-1.5 px-3 text-sm focus:outline-none hover:bg-indigo-600 rounded">Adicionar</a>
      </div>
      <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">#</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
              style="width: 150px">Imagem</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Nome</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Valor</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Estoque</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-right">
              Ações</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          @foreach ($products as $product)
          <tr>
            <td class="px-4 py-3">{{$product->id}}</td>
            <td class="px-4 py-3">
              <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                src="{{Storage::url($product->cover)}}">
            </td>
            <td class="px-4 py-3">{{$product->name}}</td>
            <td class="px-4 py-3">R${{$product->price}}</td>
            <td class="px-4 py-3">{{$product->stock}}</td>
            <td class="px-4 py-3 text-sm text-right space-x-3 text-gray-900">
              <a href="{{route('admin.products.edit', $product->id)}}" style="color: white;"
                class="btn btn-sm btn-primary btn-icon"><span><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
              <form action="{{route('admin.products.destroy', $product->id)}}" method="POST">
                @method('delete')
                @csrf
                <button style="background-color: red; margin-top: 5px;" type="submit"
                  class="btn btn-sm btn-danger btn-icon"><span><i class="fa fa-trash" aria-hidden="true"></i>
                  </span></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTable').DataTable();
  });
</script>

@endsection
