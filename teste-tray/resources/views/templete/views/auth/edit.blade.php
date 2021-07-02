@extends('templete.templete')

@section('conteudo')

    <main class="px-3 mt-5">
        <div class="container justify-content-center mt-5">
        <h1 class="mb-3">Cadastro vendedor</h1>
            <form method="POST" action="{{ route('user.update', $data->id) }}" class="row g-3 col-12 justify-content-center">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="col-8">
                    <label for="name" class="form-label">Nome do vendedor</label>
                    <input type="text" class="form-control bg-dark border border-1 border-top-0 border-end-0 border-start-0 border-white text-white" id="name" placeholder="João" name="name" value="{{$data->name}}">
                    @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-8">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control bg-dark border border-1 border-top-0 border-end-0 border-start-0 border-white text-white" id="email" placeholder="joao@mail.com" name="email" value="{{$data->email}}">
                    @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
                    <button type="submit" class="btn btn-success btn-sm">Atualizar</button>
                    <a class="btn btn-danger btn-sm" href="{{ route('user.destroy', $data->id) }}">Deletar <i class="fas fa-trash"></i></a>
                </div>
            </form>
        </div>
    </main>

@endsection