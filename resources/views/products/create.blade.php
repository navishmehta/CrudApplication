<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="space-y-4">
        <header class="bg-black py-4">
            <div class="text-center text-white text-4xl font-semibold">Simple Laravel 11 CRUD</div>
        </header>
        <div class="w-6/12 flex justify-end mx-auto">
            <a href="{{ route('products.list') }}" class="text-white bg-black w-fit font-semibold rounded-md px-4 py-2 hover:bg-gray-700">Back</a>
        </div>
        <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="post">
            @csrf
            <div class="flex flex-col justify-center mx-auto w-6/12 rounded-md shadow-lg">
                <div class="text-white bg-black px-4 py-4 font-bold text-xl">Create Product</div>
                <div class="flex flex-col px-4 py-2 gap-4 mt-2">
                    <div class="space-y-2">
                        <div class="text-black text-xl">Name</div>
                        <input class="@error('name') text-red-500 @enderror border-[1px] px-2 py-2 border-slate-300 rounded-md w-full outline-none focus:bg-slate-100" type="text" placeholder="Enter product name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <div class="text-black text-xl">Sku</div>
                        <input class="@error('name') text-red-500 @enderror border-[1px] px-2 py-2 border-slate-300 rounded-md w-full outline-none focus:bg-slate-100" type="number" placeholder="Enter product sku" name="sku" value="{{ old('sku') }}">
                        @error('sku')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <div class="text-black text-xl">Price</div>
                        <input class="@error('name') text-red-500 @enderror border-[1px] px-2 py-2 border-slate-300 rounded-md w-full outline-none focus:bg-slate-100" type="number" placeholder="Enter product Price" name="price" value="{{ old('price') }}">
                        @error('price')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <div class="text-black text-xl">Description</div>
                        <textarea class="border-[1px] px-2 py-2 border-slate-300 rounded-md w-full outline-none focus:bg-slate-100" name="description" id="description" cols="30" rows="7" value="{{ old(key: 'description') }}"></textarea>
                    </div>
                    <div class="space-y-2">
                        <div class="text-black text-xl">Image</div>
                        <input type="file" placeholder="Enter product Price" name="image">
                    </div>
                    <div class="mb-4">
                        <button class="text-white bg-blue-600 w-full rounded-md py-2 cursor-pointer hover:bg-blue-500">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>