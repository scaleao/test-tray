@extends('templete.templete')

@section('conteudo')

<main class="px-3 mt-5">
    @if($message)
        <div class="alert alert-success alert-dismissible fade show border border-success" role="alert">
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h3>{{Auth::user()->name}}</h3>
        <div class="d-flex flex-row justify-content-center mb-5">
            <div class="p2">
                <h3>
                    <span class="badge bg-success"><p>Total vendido</p>R$ {{$metricas['totalVendas']}}</span>
                    <span class="badge bg-primary"><p>Total comissão</p>R$ {{$metricas['totalComissao']}}</span>
                </h3>
            </div>
        </div> 
        <div class="d-flex flex-row justify-content-center mt-5">
            <div class="p2 mb-5">
                <form method="POST" action="{{ route('venda.store') }}" class="row gy-2 gx-3 align-items-center">
                    {{ csrf_field() }}
                    <div class="col-auto">
                        <input type="text" class="form-control bg-dark text-white" placeholder="Valor da venda R$" name="valor" onkeypress="$(this).mask('#.##0,00', {reverse: true});">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Vender <i class="fas fa-chevron-circle-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="container table-responsive">
            <table class="table col-8 table-dark table-sm caption-top text-white">
                <caption class="text-white text-center">Vendas</caption>
                <thead>
                    <tr>
                        <th scope="col"># ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Venda R$</th>
                        <th scope="col">Comissão R$</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendas as $venda)
                        <tr>
                            <th scope="row">{{$venda->id}}</th>
                            <td>{{Auth::user()->name}}</td>
                            <td>{{Auth::user()->email}}</td>
                            <td>{{$venda->valor = number_format($venda->valor, 2, ',', '.')}}</td>
                            <td>{{$venda->comissao}}</td>
                            <td>{{$venda->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection