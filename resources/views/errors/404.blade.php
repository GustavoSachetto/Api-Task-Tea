@extends('layout.app')

@section('title', 'Erro 404')

@section('content')
    <div class="text-center mt-5">
        <img src="{{asset('img/logo.png')}}"  alt="TaskTea Logo" width="230">
        <h1 class="fw-bold">Erro 404</h1>
        <h2>Parece que essa página não existe.</h2>
    </div>

    <img src="{{asset('img/teo.png')}}" class="position-absolute bottom-0 end-0" width="150">
@endsection
