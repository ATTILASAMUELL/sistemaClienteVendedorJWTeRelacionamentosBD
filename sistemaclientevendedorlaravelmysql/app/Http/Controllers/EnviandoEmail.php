<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserRegisteredEmail;

class EnviandoEmail extends Controller
{
    public function enviandoEmail(Request $request)
    {

        $array = ['error'=> ''];
        $rules=[
            'mensagem'  => 'required',
            'email' => 'required|email',
            'assunto'  => 'required'
            
        

        ];


        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            $array['errorBoolean'] = true;
            $array['error'] = $validator->messages();
            return response()->json($array, 400);
        }

        $email =  $request->input('email');
        $mensagem =  $request->input('mensagem');
        $assunto = $request->input('assunto');

        $dadosEnviar = new UserRegisteredEmail($assunto,$mensagem);
        
        Mail::to($email)->send($dadosEnviar);
    }
}
