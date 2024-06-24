@extends('layout')
@section('content')
<style>
    main {
        display: flex;
        min-height: 100vh;
    }
    .sidebar {
        width: 250px;
        background-color: #343a40;
        color: #fff;
    }
    .sidebar a {
        color: #fff;
        text-decoration: none;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .content {
        flex-grow: 1;
        padding: 20px;
    }
</style>
<main>
    @include('sidebar_layout')
    <div class="content">
        <h1>this is employee dashboard</h1>
    </div>
</main>
@endsection