<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Rol;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Rol as RolResource;
class RolController extends BaseController
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//un index es un listado, queremos que sea mostrado una lista de los registros que tenemos actualmente
    {
        $rols = Rol::all();// aqui creamos una variable de nombre rols, estavariable le ponemos con s para indicar que son varios
        //esta lista rols = a rol, una instancia de clase es un objeto, 

        return $this->sendResponse(RolResource::collection($rols), 'Rols retrieved successfully.');
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
            'rol_descripcion' => 'required',//modificar
            //modificar de acuerdo a mi tabla de bd 
            'rol_estado' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $rol = Rol::create($input);

        return $this->sendResponse(new RolResource($rol), 'Rol created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)// solo te muestra un resultado, por el index
    {
        $rol = Rol::find($id);// find igual buscar, de todos los registros solo busca el que quiero con un id

        if (is_null($rol)) { // aqui nos dice que si no encuentra un rolo no da como mensaje rolo no encontrado
            return $this->sendError('Rol not found.');
        }

        return $this->sendResponse(new RolResource($rol), 'Rol retrieved successfully.');//  su contra de 60 pero aqui crea un
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
        $rol = Rol::findOrFail($id); //  variable ($rol) que es igual a una instancia de clase (Rol) que sera igual a un registro con id ($id)

        $validator = Validator::make($input, [
            'rol_descripcion'=> 'required',//modificar de acuerdo a mi tabla de bd 
            'rol_estado' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

      
        $rol->rol_descripcion = $input['rol_descripcion'];
        $rol->rol_estado = $input['rol_estado'];
        $rol->save();

        return $this->sendResponse(new RolResource($rol), 'Rol updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return $this->sendResponse([], 'Rol deleted successfully.');
    }
}
