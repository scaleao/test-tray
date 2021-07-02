@extends('templete.templete')

@section('conteudo')

    <main class="px-3 mt-5">
        <div class="container justify-content-center mt-5">
            <h1 class="mb-3">Cadastro vendedor</h1>
            <form method="POST" action="{{ route('user.store') }}" class="row g-3 col-12 justify-content-center">
                {{ csrf_field() }}
                <div class="col-8">
                    <label for="name" class="form-label">Nome do vendedor</label>
                    <input type="text" class="form-control bg-dark border border-1 border-top-0 border-end-0 border-start-0 border-white text-white" id="name" placeholder="João" name="name">
                    @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-8">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control bg-dark border border-1 border-top-0 border-end-0 border-start-0 border-white text-white" id="email" placeholder="joao@mail.com" name="email">
                    @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-8">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control bg-dark border border-1 border-top-0 border-end-0 border-start-0 border-white text-white" id="password" name="password">
                    @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-7 mt-5 col">
                  <button type="submit" class="btn btn-success">Cadastrar vendedor</button>
                </div>
                <div class="mt-5 text-white-50">
                    <p>Já é cadastrado? Então <a href="{{ route('home.enter') }}" class="text-white">clique aqui</a></p>
                </div>
            </form>
        </div>
    </main>

@endsection