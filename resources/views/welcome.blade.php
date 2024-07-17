@extends('layout')
@section('content')
<div class="background-image"></div>
<div class="contents">
    <h1>Welcome to Our Company...</h1>
    <p class="lead">Innovating for a brighter future.</p>
    <a href="{{ auth()->check() ? (auth()->user()->role === null ? route('login') : (auth()->user()->role == 0 ? route('dashboard') : route('dashboard'))) : route('login') }}">
        Get Started
    </a>
</div>
<div style="margin-top: 80vh;"></div> <!-- Spacer to ensure footer is visible -->
@include('footer')
@endsection
