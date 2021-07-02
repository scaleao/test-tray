@extends('templete.templete')

@section('conteudo')

    <main class="px-3 mt-5">
        <div class="container mt-5">
            @if($message)
                <div class="alert alert-danger alert-dismissible fade show border border-danger" role="alert">
                {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="POST" action="{{ route('user.auth') }}" class="row g-3 col-12 justify-content-center">
                {{ csrf_field() }}
                <div class="col-8">
                    <label for="inputAddress" class="form-label">E-mail</label>
                    <input type="email" class="form-control bg-dark border border-1 border-top-0 border-end-0 border-start-0 border-white text-white" id="inputAddress" name="email">
                </div>
                <div class="col-8">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control bg-dark border border-1 border-top-0 border-end-0 border-start-0 border-white text-white" id="password" name="password">
                </div>
                <div class="col-7 mt-5 col">
                  <button type="submit" class="btn btn-success">Entrar</button>
                </div>
                <div class="mt-5 text-white-50">
                    <p>Ainda não é cadastrado? Então <a href="{{ route('home.create') }}" class="text-white">clique aqui</a></p>
                </div>
            </form>
        </div>
    </main>

@endsection