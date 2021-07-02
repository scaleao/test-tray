@component('mail::message')

    <h1>Ola! Seu Relatorio diario</h1>

    Suas vendas diarias se somaram à um total de: R$ {{$metrica->valorTotal}}
    Sua comissao diarias se somaram à um total de: R$ {{$metrica->comissaoTotal}}

    Att

@endcomponent