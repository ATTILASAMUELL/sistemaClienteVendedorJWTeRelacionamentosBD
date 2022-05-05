<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class ClienteController extends Controller
{
    //

    public function novoCliente(Request $request)
    {
        $array = ['error'=> ''];
        $rules=[
            'nome'  => 'required',
            'email' => 'required|email|unique:cliente,email',
            'foto' => 'mimes:jpg',
            'telefone'  => 'required',
            'vendedor'  => 'required',
            'tipoCliente'  => 'required'

        ];


        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            $array['errorBoolean'] = true;
            $array['error'] = $validator->messages();
            return response()->json($array, 400);
        }




        //Inserir mais validação do upload
        if($request->hasFile('foto'))
        {
            if($request->file('foto')->isValid())
            {
                $extencao = $request->file('foto')->extension();
                if($extencao != 'jpg')
                {
                    $array['errorBoolean'] = true;
                    $array['error'] = [ 'foto' => 'Arquivo com extenção diferente de JPG'];
                    return response()->json($array, 400);
                }else
                {
                    $foto = $request->file('foto')->store('public');
                    $urll = asset(Storage::url($foto));
                    
                }

            }else
            {
                $array['errorBoolean'] = true;
                $array['error'] = [ 'foto' => 'Arquivo invalido'];
                return response()->json($array, 400);

            }

        }else
        {
            $array['errorBoolean'] = true;
            $array['error'] = [ 'foto' => 'Não foi enviado arquivo nenhum'];
            return response()->json($array, 400);
        }
        $nome =ucfirst($request->input('nome'));
        $email =  $request->input('email');
        $senha = Hash::make( $request->input('senha'));
        $telefone =  $request->input('telefone');
        $url =   $urll;
        $tipoCliente = ucfirst($request->input('tipoCliente'));
        $vendedor = ucfirst($request->input('vendedor'));
        
 
        
        $cliente = Cliente::create(["nome"=> $nome ,"email"=>$email,"imagem"=>$url,"senha"=>$senha]);
        

        $cliente->telefones()->create(['telefone'=>$telefone]);
        $cliente->tipoCliente()->create(['tipoCliente'=>$tipoCliente]);
        $cliente->vendedores()->create(["nome"=>$vendedor]);

        
        
        

        return response()->json($array, 200);

    }

    public function atualizarCliente(Request $request)
    {
        $array = ['error'=> ''];
        $cliente = Cliente::where('id',$request->input('id'))->first();

        if($cliente)
        {

            
            $rules=[
                'nome'  => 'required',
                'email' => 'required|email',
                
                'telefone'  => 'required',
                'vendedor'  => 'required',
                'tipoCliente'  => 'required'

            ];


        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            $array['errorBoolean'] = true;
            $array['error'] = $validator->messages();
            return response()->json($array, 400);
        }

        //Inserir mais validação do upload
        if(($request->hasFile('foto')) && (!$request->input('url')) )
        {
            if($request->file('foto')->isValid())
            {
                $extencao = $request->file('foto')->extension();
                if($extencao != 'jpg')
                {
                    $array['errorBoolean'] = true;
                    $array['error'] = [ 'foto' => 'Arquivo com extenção diferente de JPG'];
                    return $array;
                }else
                {
                    $foto = $request->file('foto')->store('public');
                    $urll = asset(Storage::url($foto));
                    
                }

            }else
            {
                $array['errorBoolean'] = true;
                $array['error'] = [ 'foto' => 'Arquivo invalido'];
                return $array;

            }



        }else{
            $urll = $request->input('url');

        }

        $nome = ucfirst($request->input('nome'));
        $email =  $request->input('email');
        $senha = Hash::make( $request->input('password'));
        $telefone =  $request->input('telefone');
        $url =   $urll;
        $tipoCliente = $request->input('tipoCliente');
        $vendedor = ucfirst($request->input('vendedor'));
        
 
        
        $cliente->update(['nome' => $nome,'email'=>$email, 'senha'=>$senha, 'imagem' => $url]);
        $cliente->telefones()->update(['telefone'=>$telefone]);
        $cliente->vendedores()->update(['nome'=>$vendedor]);
        $cliente->tipoCliente()->update(['tipoCliente'=>$tipoCliente]);
    
        
        

        

        
        
        

        


        }

        $array['error'] = $request->input('nome');
        return response()->json($array, 200);
    }

    public function listarTodosCliente()
    {
        
        try{
            $clientes = Cliente::with(['telefones','tipoCliente','vendedores'])->get();

            return  response()->json($clientes, 200);
        } catch(QueryException $e) {
            // You can check get the details of the error using `errorInfo`:
            
        
            return response()->json(["error"], 401);
        }

        
        
    }

    public function deletandoCliente($id)
    {

        $excluirCliente = Cliente::find($id);

        $excluirCliente->telefones()->delete();
        $excluirCliente->tipoCliente()->delete();
        $excluirCliente->vendedores()->delete();
        $excluirCliente->delete();
        
        
        //Cliente::findOrFail($id)->telefones()->delete() ;
        //Cliente::findOrFail($id)->tipoCliente()->delete();
        //Cliente::findOrFail($id)->vendedores()->delete();
        //Cliente::findOrFail($id)->delete();
        

       
        

        
    }
}
