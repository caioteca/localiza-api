<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Sugestoe;
use Validator;
use App\Http\Resources\Sugestoe as SugestoeResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SugestoeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $type = $request->input('type');
        if($type!=''){//pegar dados com params type
            $Sugestoes = DB::table('sugestoes')->where(['type'=>$type])->get();
            return $this->sendResponse(SugestoeResource::collection($Sugestoes), 
        'Filtro de reclamações/sugestões.');
        }else{
            
                                $Sugestoes = Sugestoe::all();
                                return $this->sendResponse(SugestoeResource::collection($Sugestoes), 
                                'Lista de sugestões/reclamações.');
                            } 
                        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_user=1;
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'sugestao' => 'required',
            'type' => 'required',
            'id_user' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Erro ao inserir.', $validator->errors());       
        }
   
        $Sugestoe = Sugestoe::create($input);
   
        return $this->sendResponse(new SugestoeResource($Sugestoe), 
        'Registrado com sucesso.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Sugestoe = Sugestoe::find($id);
  
        if (is_null($Sugestoe)) {
            return $this->sendError('Nenhum resultado encontrado.');
        }
   
        return $this->sendResponse(new SugestoeResource($Sugestoe), 
        'Resultado encontrado.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sugestoe $Sugestoe)
    {
        //
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sugestoe $Sugestoe)
    {
        $Sugestoe->delete();
   
        return $this->sendResponse([], 'Apagado com sucesso.');
    }
}