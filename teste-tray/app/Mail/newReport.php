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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $hoje = str_replace('/', '-', date('Y/m/d'));
        $this->metricas = Venda::select(DB::raw('SUM(valor) as valorTotal'), 
                                    DB::raw('SUM(comissao) as comissaoTotal'))
                            ->where('created_at', 'like', $hoje.'%')
                            ->groupBy('user_id')
                            ->get();
        
        $this->users = DB::table('users')
                ->join('vendas', 'users.id', '=', 'vendas.user_id')
                ->select('users.email', 'users.name')
                ->whereDate('vendas.created_at', $hoje)
                ->groupBy('users.email', 'users.name')
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
            $this->to($this->user->email, $this->user->name);
            foreach($this->metricas as $metrica){
                return $this->markdown('mail.newReport', [
                    'metricas' => $this->metrica
                ]);
            }
        }
    }
}
