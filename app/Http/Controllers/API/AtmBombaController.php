<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Atm_bomba;
use Validator;
use App\Http\Resources\Atm_bomba as Atm_bombaResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AtmBombaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $status_admin=1;//Auth::role(); // admin role 1
        $status_informer=2;//Auth::role() //informer role 2
        $status = $request->input('status');
        $type = $request->input('type');
        $bloquear_desbloquear = $request->input('bloquear_desbloquear');
        $change_status = $request->input('change_status');

        if($status!='' && $type!=''){//pegar dados com params status e type
            $Atm_bombas = DB::table('atm_bombas')->where(['type'=>$type,'status'=>$status])->get();
            return $this->sendResponse(Atm_bombaResource::collection($Atm_bombas), 
        'Filtro de lista de atm e bombas.');
        }else{
            if($bloquear_desbloquear!='' && $status_admin==1){//bloquear ponto
                $result = DB::table('atm_bombas')->where('id', $bloquear_desbloquear)->pluck('status');
                $status1 = str_replace("[",'',$result);//remover matriz
                $status2 = str_replace("]",'',$status1);//remover matriz
                if($status2==$bloquear_desbloquear){
                $db_status=$status2==1?0:1;
                $Atm_bombas = DB::update(DB::raw('UPDATE atm_bombas SET enabled=0 WHERE id ='.$bloquear_desbloquear.'  '));
                //$user = DB::table('atm_bombas')->find(3);
                //$Atm_bombas =DB::table('atm_bombas')->where('id', 3)->update(['status'=> 0]); forma 1
                //$Atm_bombas =DB::table('atm_bombas')->where('id', 3)->update(['location' =>DB::raw("'Heena Khan'")]); forma 2
                //return $this->sendResponse(Atm_bombaResource::collection($Atm_bombas),
                //'Ponto bloqueado com sucesso.');
                return response()->json('Ponto bloqueado com sucesso');
                }else{
                return response()->json(['message' =>'Este ponto não existe!']);
                }
            }else{

            $Atm_bombas = Atm_bomba::all();
            return $this->sendResponse(Atm_bombaResource::collection($Atm_bombas), 
            'Lista de atm e bombas geral.');
        }
    }
        /*
       */

        /*else{
            if($bloquear!='' && $status_admin==1){//bloquear ponto
                $Atm_bombas = DB::update(DB::raw('UPDATE atm_bombas SET enabled=0 WHERE id ='.$bloquear.'  '));
                //$user = DB::table('atm_bombas')->find(3);
                //$Atm_bombas =DB::table('atm_bombas')->where('id', 3)->update(['status'=> 0]); forma 1
                //$Atm_bombas =DB::table('atm_bombas')->where('id', 3)->update(['location' =>DB::raw("'Heena Khan'")]); forma 2
                //return $this->sendResponse(Atm_bombaResource::collection($Atm_bombas),
                //'Ponto bloqueado com sucesso.');
                return response()->json('Ponto bloqueado com sucesso');
            }else{
                if($desbloquear!='' && $status_admin==1){
                    $Atm_bombas = DB::update(DB::raw('UPDATE atm_bombas SET enabled=1 WHERE id ='.$desbloquear.'  '));
                    return response()->json('Ponto desbloqueado com sucesso');
                }else{
                    if($desbloquear!='' || $bloquear!='' && $status_admin!=1){
                    return response()->json('Não autorizado!');
                    }else{
                        if($status_informer==2 || $status_admin==1 && $change_status!=''){ 
                            //$Atm_bombas = DB::table('atm_bombas')->get();
                            /*$db_status=null;
                            $estado=$db_status==1?0:1;
                            $Atm_bombas = DB::update(DB::raw('UPDATE atm_bombas SET status='.$estado.' WHERE id ='.$change_status.'  '));
                            return response()->json('Estado alterado com sucesso');
                            //return response()->json($Atm_bombas);
                        }else{
                            if($status_informer!=2 || $status_admin!=1 && $change_status!=''){
                                return response()->json('Não autorizado!');
                            }else{
                               
                            } 
                        }
                    }
                }
            }
        }*/

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Erro ao inserir.', $validator->errors());       
        }
   
        $Atm_bomba = Atm_bomba::create($input);
   
        return $this->sendResponse(new Atm_bombaResource($Atm_bomba), 
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
        $Atm_bomba = Atm_bomba::find($id);
  
        if (is_null($Atm_bomba)) {
            return $this->sendError('Nenhum resultado encontrado.');
        }
   
        return $this->sendResponse(new Atm_bombaResource($Atm_bomba), 
        'Resultado encontrado.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atm_bomba $Atm_bomba)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Erro ao atualizar.', $validator->errors());       
        }
   
        $Atm_bomba->location = $input['location'];
        $Atm_bomba->latitude = $input['latitude'];
        $Atm_bomba->longitude = $input['longitude'];
        $Atm_bomba->type = $input['type'];
        $Atm_bomba->save();
   
        return $this->sendResponse(new Atm_bombaResource($Atm_bomba), 
        'Atualizado com sucesso.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atm_bomba $Atm_bomba)
    {
        $Atm_bomba->delete();
   
        return $this->sendResponse([], 'Apagado com sucesso.');
    }
}