<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message = "")
    {
        $id = Auth::user()->id;
        $vendas = Venda::get()->where('user_id', $id);
        $totalVendas = Venda::get()->where('user_id', $id)->sum('valor');
        $totalComissao = Venda::get()->where('user_id', $id)->sum('comissao');
        $metricas = [
            'totalVendas' => number_format($totalVendas, 2, ",", "."),
            'totalComissao' => number_format($totalComissao, 2, ",", ".")
        ];
        return view('templete.views.auth.dashboard', compact('message', 'vendas', 'metricas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'valor' => 'required'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['valor'] = str_replace(".", "", $data['valor']);
        $data['valor'] = str_replace(",", ".", $data['valor']);
        $data['valor'] = floatval($data['valor']);
        $data['comissao'] = $data['valor'] * 0.085;
        $venda = Venda::create($data);
        if($venda){
            $message = "Venda realizada com sucesso !";
            //return redirect()->route('dashboard', $message);
            return redirect()->route('dashboard', $message);
        }
        /*$request['valor'] = str_replace(".", "", $request['valor']);
        //string "1.000,00" ==> "1000,00"
        $request['valor'] = str_replace(",", ".", $request['valor']);
        //string "1000,00" ==> "1000.0"
        $request['valor'] = floatval($request['valor']);
        //float 1000.00
        $request['valor'] = $request['valor'] * 0.085;
        $request['valor'] = floatval(number_format($request['valor'], 2, '.', ''));
        dd($request['valor']);
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show(Venda $venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venda $venda)
    {
        //
    }

    public function send(){
        
    }
}
