<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class newReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $metricas;
    protected $users;
    protected $relatorios;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $hoje = str_replace('/', '-', date('Y/m/d'));
        $this->metricas = Venda::select(
                            DB::raw('SUM(valor) as valorTotal'), 
                            DB::raw('SUM(comissao) as comissaoTotal'
                        ), 'user_id')
                ->where('created_at', 'like', $hoje.'%')
                ->groupBy('user_id')
                ->get();
        
        $this->users = DB::table('users')
                ->join('vendas', 'users.id', '=', 'vendas.user_id')
                ->select('users.email', 'users.name', 'users.id')
                ->whereDate('vendas.created_at', $hoje)
                ->groupBy('users.email', 'users.name', 'users.id')
                ->get();

        $this->relatorios = Venda::select('vendas.*', 'users.email', 'users.name')
                ->join('users', 'vendas.user_id', '=', 'users.id')
                ->whereDate('vendas.created_at', $hoje)
                ->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach($this->users as $user){
            $this->subject('Relatorio diario, teste Tray');
            $this->to($user->email, $user->name);
            return $this->markdown('mail.newReport', [
                'metricas' => $this->metrica,
                'relatorios' => $this->relatorios,
                'user_session' => $user
            ]);
        }
    }
}
