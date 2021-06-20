<?php

namespace App\Http\Controllers;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Anio_lectivo;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Anio_lectivo as Anio_lectivoResource;
class AnioLectivoController extends BaseController
{
           /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//un index es un listado, queremos que sea mostrado una lista de los registros que tenemos actualmente
    {
        $anio_lectivos = Anio_lectivo::all();// aqui creamos una variable de nombre anio_lectivos, estavariable le ponemos con s para indicar que son varios
        //esta lista anio_lectivos = a anio_lectivo, una instancia de clase es un objeto, 

        return $this->sendResponse(Anio_lectivoResource::collection($anio_lectivos), 'anio_lectivos retrieved successfully.');
        //esta linea nos devuelve la lista de objetos. index es mostrar 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();// aqui definimos un imput, (imput  es ingresa)

        $validator = Validator::make($input, [// aqui estamos creando validator(con metodo meke) y como segundo parameto le estamos poniendo los campos que le estamos poniendo
            'anio_lectivo_inicio' => 'required',//modificar
            //modificar de acuerdo a mi tabla de bd 
            'anio_lectivo_fin' => 'required',
            'anio_lectivo_estado' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $anio_lectivo = Anio_lectivo::create($input);

        return $this->sendResponse(new Anio_lectivoResource($anio_lectivo), 'Anio_lectivo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)// solo te muestra un resultado, por el index
    {
        $anio_lectivo = Anio_lectivo::find($id);// find igual buscar, de todos los registros solo busca el que quiero con un id

        if (is_null($anio_lectivo)) { // aqui nos dice que si no encuentra un anio_lectivoo no da como mensaje anio_lectivoo no encontrado
            return $this->sendError('Anio_lectivo not found.');
        }

        return $this->sendResponse(new Anio_lectivoResource($anio_lectivo), 'Anio_lectivo retrieved successfully.');//  su contra de 60 pero aqui crea un
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $input = $request->all();
        $anio_lectivo = Anio_lectivo::findOrFail($id); //  variable ($anio_lectivo) que es igual a una instancia de clase (Anio_lectivo) que sera igual a un registro con id ($id)

        $validator = Validator::make($input, [
            'anio_lectivo_descripcion'=> 'required',//modificar de acuerdo a mi tabla de bd 
            'anio_lectivo_fin' => 'required',
            'anio_lectivo_estado' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

      
        $anio_lectivo->anio_lectivo_descripcion = $input['anio_lectivo_descripcion'];
        $anio_lectivo->anio_lectivo_fin = $input['anio_lectivo_fin'];
        $anio_lectivo->anio_lectivo_estado = $input['anio_lectivo_estado'];
        $anio_lectivo->save();

        return $this->sendResponse(new Anio_lectivoResource($anio_lectivo), 'Anio_lectivo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        $anio_lectivo = Anio_lectivo::findOrFail($id);
        $anio_lectivo->delete();

        return $this->sendResponse([], 'Anio_lectivo deleted successfully.');
    }
}
