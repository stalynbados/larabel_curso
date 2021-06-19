<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Curso;//aqui importamos el modelos que hace referencia a las tablas de base de datos//
//use Validator; //solo para validad los campos obligatorios 
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Curso as CursoResource; //aqui tambien importamos 

class CursoController extends  BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//un index es un listado, queremos que sea mostrado una lista de los registros que tenemos actualmente
    {
        $cursos = Curso::all();// aqui creamos una variable de nombre cursos, estavariable le ponemos con s para indicar que son varios
        //esta lista cursos = a curso, una instancia de clase es un objeto, 

        return $this->sendResponse(CursoResource::collection($cursos), 'Cursos retrieved successfully.');
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
            'curso_nombre' => 'required',//modificar
            'curso_descripcion',//modificar de acuerdo a mi tabla de bd 
            'curso_estado' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $curso = Curso::create($input);

        return $this->sendResponse(new CursoResource($curso), 'Curso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)// solo te muestra un resultado, por el index
    {
        $curso = Curso::find($id);// find igual buscar, de todos los registros solo busca el que quiero con un id

        if (is_null($curso)) { // aqui nos dice que si no encuentra un cursoo no da como mensaje cursoo no encontrado
            return $this->sendError('Curso not found.');
        }

        return $this->sendResponse(new CursoResource($curso), 'Curso retrieved successfully.');//  su contra de 60 pero aqui crea un
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
        $curso = Curso::findOrFail($id); //  variable ($curso) que es igual a una instancia de clase (Curso) que sera igual a un registro con id ($id)

        $validator = Validator::make($input, [
            'curso_nombre' => 'required',//modificar
            'curso_descripcion'=> 'required',//modificar de acuerdo a mi tabla de bd 
            'curso_estado' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $curso->curso_nombre = $input['curso_nombre'];
        $curso->curso_descripcion = $input['curso_descripcion'];
        $curso->curso_estado = $input['curso_estado'];
        $curso->save();

        return $this->sendResponse(new CursoResource($curso), 'Curso updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return $this->sendResponse([], 'Curso deleted successfully.');
    }
}
