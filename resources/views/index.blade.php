{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Inicio - BitKeys')

@section('content')
@vite(['resources/scss/pages/index.scss'])

<main>
    @include('products.index')
</main>
@endsection