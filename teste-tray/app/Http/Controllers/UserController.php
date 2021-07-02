<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Venda;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templete/views/create');
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
            'email' => 'required',
            'name' => 'required',
            'password' => 'required'
        ]);
        $request->flash();
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        
        if($user){
            return redirect()->route('home.enter');
        }
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $request->flash();
        $data = $request->all();
        if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
            return redirect()->route('dashboard');
        }
        else{
            $message = "email ou senha incorreto(s)";
            return redirect()->route('home.enter', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id)->first();
        return view('templete.views.auth.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        
        $data = $request->all();
        $update = User::find($id)->update($data);
        
        if($update){
            $message = "Vendedor ataulizado com sucesso";
            return redirect()->route('dashboard', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $vendas = Venda::get()->where('user_id', $id)->first();
        if($vendas){
            $cascadeVendas = Venda::where('user_id', $id)->delete();
            if($cascadeVendas){
                $delete = User::find($id)->delete();
                if($delete){
                    return redirect()->route('home', $message);
                }
            }
        }
        $delete = User::find($id)->delete();
        if($delete){
            return redirect()->route('home', $message);
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
