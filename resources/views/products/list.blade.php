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
        @if (Session::has('success'))
        <div class="w-6/12 bg-green-200 text-green-600 p-4 mx-auto rounded-md py-4">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="w-6/12 flex justify-end mx-auto">
            <a href="{{ route('products.create') }}" class="text-white bg-black w-fit rounded-md font-semibold px-4 py-2 hover:bg-gray-700">Create</a>
        </div>
        <div class="flex flex-col justify-center mx-auto w-6/12 rounded-md shadow-lg">
            <div class="text-white bg-black px-4 py-4 font-bold text-xl">Products</div>
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
                            @if ($product->image != "")
                            <img width="50" src="{{ url('uploads/products/'.$product->image) }}" alt="image" />
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $product->name }}</td>
                        <td class="px-6 py-3">{{ $product->sku }}</td>
                        <td class="px-6 py-3">${{ $product->price }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                        <td class="px-6 py-3 space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-white bg-green-600 p-2 rounded-md">Edit</a>
                            <a href="#" onclick="deleteProduct({{ $product->id }});" class="text-white bg-red-600 p-2 rounded-md">Delete</a>
                            <form id="delete-product-form-{{$product->id}}" action="{{ route('products.destroy',$product->id) }}" method="post">
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
    </div>
</body>

</html>

<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you sure you want to delete product?")) {
            document.getElementById("delete-product-form-" + id).submit();
        }
    }
</script>