<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class RolController extends ApiController
{
    
    /**GET */
    public function index()
    {
        $rol = Rol::all();
        return $this->showAll($rol);
    }

    /** */
    public function show(Rol $rol)
    {
        return $this->showOne($rol);
    }

    /**POST */
    public function store(Request $request)
    {
        $rules = [
            'rol' => 'required',
            'description' => 'required',
        ];
        $this->validate($request, $rules);

        $rol = Rol::create( $request->all() ); 
        /* $rol = new Rol();
         $rol->rol = $request->input('rol');
         $rol->description = $request->input('description');
         $rol->status = $request->input('status');
         $rol->save(); */
       
        
         return  $this->showOne($rol);
    }
    /**PUT */
    public function update(Request $request,Rol $rol)
    {
        $rol->fill($request->only([ 
            // fill recibe los valores a actualizar y only toma solo los valores a actualizar || only se usa para versiones de laravel despues de 5.5 en este caso usamos intersect
            'rol',
            'description',
            'status'
        ]));
        if ($rol->isClean()) { // is la instancia no ha cambiado o no se ha actualizado ningún valor
            return $this->errorResponse('Debe especificar al menos un valor diferente', 422);
        }

        $rol->save();
        return $this->showOne($rol);

      /*
        $rol = Rol::find( $rol_id );
        $rol->rol = $request->input('rol');
        $rol->description = $request->input('description');
        $rol->status = $request->input('status');
        $rol->save();
      */  
    }
     /**PUT */
    public function destroy(Rol $rol)
    {
        $rol->delete();
        return $this->showOne($rol);
    }
}
