{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Inicio - BitKeys')

@section('content')


    <main class="page-index">
        @include('products.index')
    </main>
@endsection