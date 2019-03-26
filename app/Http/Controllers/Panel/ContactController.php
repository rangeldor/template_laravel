<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;

class ContactController extends Controller
{
   /* public function index(){
        $data['titulo'] = "Minha página de contato.";
        return view('contato',$data);
    }
    */
   
    public function send(Request $request)
    {
        /*
        $data = array(
            'assunto' => $request->input('assunto'),
            'mensagem' => $request->input('mensagem'),
        );
*/
        $message = "Qualquer coisa";
        $data = array(
            'assunto' => 'teste de envio',
            'mensagem' => 'mensagem teste',
        );

        
        Mail::send('panel.contato', $data, function ($message) {
            $message->from('rangeldor@gmail.com', 'Nome que aparece na mensagem.');
            $message->subject("Mensagem encaminhada por meio do formulário de contato.");
            $message->to('avenger3414@gmail.com')
                ->cc('dirlei.net@hotmail.com');
        });

        return view('panel.contato');

    }
}
    
    