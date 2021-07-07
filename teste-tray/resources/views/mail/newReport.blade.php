@component('mail::message')

    @foreach($user_session as $user)
        <h1>Ola, {{$user->name}}! Seu Relatorio diario</h1>
        @foreach($this->relatorios as $relatorio)
                @if($user->email == $relatorio->email){
                    Valor da venda: {{$relatorio->valor}} Comissao: {{$relatorio->comissao}}
                @endif
        @endforeach
        @foreach($metricas as $metrica){
                @if($user->id == $metrica->user_id){
                    Total vendas diarias: R$ {{$metrica->valorTotal}}
                    Total comissao diaria: R$ {{$metrica->comissaoTotal}}
                @endif
        @endforeach
        
        Att
    @endforeach

@endcomponent