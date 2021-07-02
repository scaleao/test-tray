@extends('templete.templete')

@section('conteudo')

    <main class="px-3 mt-5">
        <h1 class="mt-5">Prova Prática para Programador PHP I.</h1>
        <p class="lead text-center">Desenvolver um sistema para cadastro de vendas para vendedores e calcular a comissão dessas vendas (a comissão será de 8.5% sobre o valor da venda)</p>
        <p class="lead text-center  mt-5">
            <a href="{{ route('home.create') }}" class="btn btn-lg btn-secondary fw-bold border-white bg-white text-dark">Cadastrar vendedor <i class="fas fa-sign-in-alt"></i></a>
        </p>
    </main>

@endsection