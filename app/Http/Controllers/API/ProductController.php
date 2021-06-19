<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;//aqui importamos el modelos que hace referencia a las tablas de base de datos//
use Validator; //solo para validad los campos obligatorios 
use App\Http\Resources\Product as ProductResource; //aqui tambien importamos 

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//un index es un listado, queremos que sea mostrado una lista de los registros que tenemos actualmente
    {
        $products = Product::all();// aqui creamos una variable de nombre products, estavariable le ponemos con s para indicar que son varios
        //esta lista products = a product, una instancia de clase es un objeto, 

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
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
            'name' => 'required',//modificar
            'detail' => 'required'//modificar de acuerdo a mi tabla de bd 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)// solo te muestra un resultado, por el index
    {
        $product = Product::find($id);// find igual buscar, de todos los registros solo busca el que quiero con un id

        if (is_null($product)) { // aqui nos dice que si no encuentra un producto no da como mensaje producto no encontrado
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');//  su contra de 60 pero aqui crea un
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
        $product = Product::findOrFail($id);
        $input = $request->all();
        //  variable ($product) que es igual a una instancia de clase (Product) que sera igual a un registro con id ($id)

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'// modificamos 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
