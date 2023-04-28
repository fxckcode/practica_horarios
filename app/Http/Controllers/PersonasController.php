<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $personas = User::join('municipios', 'municipios.id_municipio', '=', 'personas.fk_municipio')->select('personas.*', 'municipios.nombre_mpio as municipio', 'municipios.departamento as departamento')->get();
            return response()->json($personas, 200);
        } catch (\Exception $e) {
            return response()->json($e, 404);
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
        try {
            $request->validate([
                'identificacion' => 'required|string',
                'nombres' => 'required|string',
                'email' => 'email',
                'telefono' => 'string',
                'rol' => 'required|integer',
                'cargo' => 'required|integer',
                'fk_municipio' => 'required|integer'
            ]);

            $persona = new User();
            $persona->identificacion = $request->identificacion;
            $persona->nombres = $request->nombres;
            $persona->email = $request->email;
            $persona->telefono = $request->telefono;
            $persona->rol = $request->rol;
            $persona->cargo = $request->cargo;
            $persona->fk_municipio = $request->fk_municipio;
            $persona->save();

            return response()->json($persona, 201);
        } catch (\Exception $e) {
            return response()->json($e, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (User::find($id)) {
                $persona = User::where('id_persona', $id)->join('municipios', 'municipios.id_municipio', '=', 'personas.fk_municipio')->select('personas.*', 'municipios.nombre_mpio as municipio', 'municipios.departamento as departamento')->first();
                return response()->json($persona, 200);
            } else {
                response()->json([
                    'message' => 'id not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json($e, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {  
            $request->validate([
                'identificacion' => 'string',
                'nombres' => 'string',
                'email' => 'email',
                'telefono' => 'string',
                'rol' => 'integer',
                'cargo' => 'integer',
                'fk_municipio' => 'integer'
            ]);

            $persona = User::findOrFail($id)->update($request->all());
            if ($persona) {
                return response()->json(User::find($id), 201);
            } else {
                return response()->json([
                    'message' => 'error data'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json($e, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (User::find($id)) {
                User::destroy($id);
                return response()->json([
                    'message' => 'delete success'
                ], 201);
            } else {
                return response()->json([
                    'message' => 'id not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json($e, 404);
        }
    }
}
