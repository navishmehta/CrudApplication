@extends('layouts.app')

{{-- style="display: flex; justify-content: space-between "  --}}
@section('content')
  <div class="flex flex-row justify-between w-6/12 mx-auto">
    <a href="{{ route('products.create') }}" 
    class="px-4 py-2 font-semibold text-white w-fit bg-black rounded-md  hover:bg-gray-700">Create</a>
    <a href="{{ route('products.logout') }}" 
    class="px-4 py-2 font-semibold text-white w-fit bg-black rounded-md hover:bg-gray-700">Logout</a>
  </div>
  <div class="flex flex-col justify-center w-6/12 mx-auto rounded-md shadow-lg">
    <div class="px-4 py-4 text-xl font-bold text-white bg-black">Products</div>
    <div class="flex">
      <table class="w-full text-lg text-left">
        <thead class="w-full text-lg uppercase bg-gray-100">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3"></th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Sku</th>
            <th class="px-6 py-3">Price</th>
            <th class="px-6 py-3">Created</th>
            <th class="px-6 py-3">Action</th>
          </tr>
        </thead>
        @if ($products->isNotEmpty())
          @foreach ($products as $product)
            <tr class="border-t-2">
              <td class="px-6 py-3">{{ $product->id }}</td>
              <td class="px-6 py-3">
                @if ($product->image != '')
                  <img width="50" src="{{ url('uploads/products/' . $product->image) }}" alt="image" />
                @endif
              </td>
              <td class="px-6 py-3">{{ $product->name }}</td>
              <td class="px-6 py-3">{{ $product->sku }}</td>
              <td class="px-6 py-3">${{ $product->price }}</td>
              <td class="px-6 py-3">{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
              <td class="px-6 py-3 space-x-2">
                <a href="{{ route('products.edit', $product->id) }}"
                  class="p-2 text-white bg-green-600 rounded-md">Edit</a>
                <a href="#" onclick="deleteProduct({{ $product->id }});"
                  class="p-2 text-white bg-red-600 rounded-md">Delete</a>
                <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}"
                  method="post">
                  @csrf
                  @method('delete')
                </form>
              </td>
            </tr>
          @endforeach
        @endif
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function deleteProduct(id) {
      if (confirm("Are you sure you sure you want to delete product?")) {
        document.getElementById("delete-product-form-" + id).submit();
      }
    }
  </script>
@endsection
