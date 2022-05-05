<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    //

    public function novoVendedor(Request $request)
    {
        $array = ['error'=> ''];
        $rules=[  
            'nome' => 'required',
            
        ];


        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            $array['errorBoolean'] = true;
            $array['error'] = $validator->messages();
            return response()->json($array, 400);
        }

        $nome = $request->input('nome');

        Vendedor::create(['nome'=> $nome]);

        $array['errorBoolean'] = false;
        return response()->json($array, 200);
        

    }
    public function pegarVendedores()
    {
        $array = ['error'=> ''];
        $capturarVendedores = Vendedor::all();
        $vendedores = [];

        foreach($capturarVendedores as $valores)
        {
            array_push($vendedores,$valores['nome']);

        }

        $dadosLimpos = array_unique($vendedores, SORT_REGULAR);
        $array['errorBoolean'] = false;
        $array['vendedor'] = $dadosLimpos;
        return response()->json($array, 200);
    }
}
