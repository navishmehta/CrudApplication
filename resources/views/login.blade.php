@extends('layouts.app')  

        @section('signup_content')
            @include('components.landing-form', ['signup'=> false])            
        @endsection    
