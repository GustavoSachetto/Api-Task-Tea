@extends('layout.app')

@section('title', 'Verificação de email')

@section('content')
    <div class="text-center mt-5">
        <img src="{{asset('img/logo.png')}}"  alt="TaskTea Logo" width="230">
        <h1 class="fw-bold text-danger">Atenção!</h1>

        @if (session('status'))
            <h2>{{ session('status') }}</h2>
        @else
            <script>window.location.href = '/404';</script>
        @endif
    </div>

    <img src="{{asset('img/teo.png')}}" class="position-absolute bottom-0 end-0" width="150">
@endsection
