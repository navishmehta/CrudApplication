@props([
    'signup' => true
])


<div class="flex justify-center items-center w-[100vw] h-[100vh] bg-gradient-to-b from-sky-800 via-slate-400 to-cyan-600">
    {{-- card --}}    
        <form class="flex flex-col p-10 items-center w-[26%] mx-auto bg-slate-50 rounded-lg gap-6" enctype="multipart/form-data" action="{{$signup ? route('products.login') : route('products.list')}}" method={{$signup ? "post" : "get"}}>
            @csrf
            <h1 class="font-bold text-3xl">{{$signup ? 'Signup' :" Login"}}</h1>
            @if ($signup)
                <input class="w-full py-3 px-2 border-2 rounded-md focus:outline-none" type="email" placeholder="Enter your name">                
            @endif
            <input class="w-full py-3 px-2 border-2 rounded-md focus:outline-none" type="email" placeholder="Enter your email address">
            <input class="w-full py-3 px-2 border-2 rounded-md focus:outline-none" type="password" placeholder="Enter your password">
            <button type="submit" class="w-full bg-sky-600 text-white p-4 hover:bg-sky-500 rounded-lg mt-5">Login</button>
            <div class="w-full h-[1px] bg-slate-800 mt-5"></div>
            @if ($signup)
                <a class="hover:text-blue-700 hover:underline font-semibold" href="/">Already have an account</a>    
            @else
                <a class="hover:text-blue-700 hover:underline font-semibold" href="/signup">Crate new account</a>    
            @endif
            
        </form>    
</div>