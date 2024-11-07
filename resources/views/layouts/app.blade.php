<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
  </head>
  <body>
    <div class="space-y-4">
      <header class="py-4 bg-black">
        <div class="text-4xl font-semibold text-center text-white">Simple Laravel 11 CRUD</div>
      </header>
      @yield('signup_content')      
      @if (Session::has('success'))
        <div class="w-6/12 p-4 py-4 mx-auto text-green-600 bg-green-200 rounded-md">
          {{ Session::get('success') }}
        </div>
      @endif
      @yield('content')
    </div>
    @yield('scripts')
  </body>
</html>
