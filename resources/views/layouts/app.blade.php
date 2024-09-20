@extends('layout')
@section('content')
<head>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style type="text/css">
        .img-user{
            width: 40px;
            border-radius: 50%;
        }
        .col-md-1{
            padding-right: 0px !important;
        }
        .img-col{
            width: 5.33% !important;
        }
    </style>
</head>
<div id="app">
    <main class="py-4">
        @yield('content')
    </main>
</div>
@endsection

