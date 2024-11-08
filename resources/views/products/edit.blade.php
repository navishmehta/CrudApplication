@extends('layouts.app')

@section('content')
  <div class="flex flex-row justify-between w-6/12 mx-auto">
    <a href="{{ route('products.list') }}"
      class="px-4 py-2 font-semibold text-white bg-black rounded-md w-fit hover:bg-gray-700">Back</a>
      <a href="{{ route('products.logout') }}"
      class="px-4 py-2 font-semibold text-white bg-black rounded-md w-fit hover:bg-gray-700">Logout</a>
  </div>
  <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="post">
    @method('put')
    @csrf
    <div class="flex flex-col justify-center w-6/12 mx-auto rounded-md shadow-lg">
      <div class="px-4 py-4 text-xl font-bold text-white bg-black">Edit Product</div>
      <div class="flex flex-col gap-4 px-4 py-2 mt-2">
        <div class="space-y-2">
          <div class="text-xl text-black">Name</div>
          <input
            class="@error('name') text-red-500 @enderror w-full rounded-md border-[1px] border-slate-300 px-2 py-2 outline-none focus:bg-slate-100"
            type="text" placeholder="Enter product name" name="name" value="{{ old('name', $product->name) }}">
          @error('name')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <div class="space-y-2">
          <div class="text-xl text-black">Sku</div>
          <input
            class="@error('name') text-red-500 @enderror w-full rounded-md border-[1px] border-slate-300 px-2 py-2 outline-none focus:bg-slate-100"
            type="number" placeholder="Enter product sku" name="sku" value="{{ old('sku', $product->sku) }}">
          @error('sku')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <div class="space-y-2">
          <div class="text-xl text-black">Price</div>
          <input
            class="@error('name') text-red-500 @enderror w-full rounded-md border-[1px] border-slate-300 px-2 py-2 outline-none focus:bg-slate-100"
            type="number" placeholder="Enter product Price" name="price" value="{{ old('price', $product->price) }}">
          @error('price')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <div class="space-y-2">
          <div class="text-xl text-black">Description</div>
          <textarea class="w-full rounded-md border-[1px] border-slate-300 px-2 py-2 outline-none focus:bg-slate-100"
            cols="30" rows="7" id="description" name="description" placeholder="Enter your product description">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="space-y-2">
          <div class="text-xl text-black">Image</div>
          <input type="file" placeholder="Enter product Price" name="image">
          @if ($product->image != '')
            <img class="w-40 my-3" src="{{ url('uploads/products/' . $product->image) }}" alt="image" />
          @endif
        </div>
        <div class="mb-4">
          <button class="w-full py-2 text-white bg-blue-600 rounded-md cursor-pointer hover:bg-blue-500">Update</button>
        </div>
      </div>
    </div>
  </form>
@endsection
