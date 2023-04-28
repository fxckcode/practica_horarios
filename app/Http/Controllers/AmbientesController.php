<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambientes;

class AmbientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ambientes = Ambientes::join('municipios', 'municipios.id_municipio', '=', 'ambientes.fk_municipio')->select('ambientes.*', 'municipios.nombre_mpio as municipio', 'municipios.departamento as departamento')->get();
            return response()->json($ambientes, 200);
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
                'nombre_amb' => 'required|string',
                'fk_municipio' => 'required|integer',
                'sede' => 'required|integer',
                'estado' => 'required|integer'
            ]);

            $ambiente = new Ambientes();
            $ambiente->nombre_amb = $request->nombre_amb;
            $ambiente->fk_municipio = $request->fk_municipio;
            $ambiente->sede = $request->sede;
            $ambiente->estado = $request->estado;
            $ambiente->save();

            return response()->json($ambiente, 201);
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
            if (Ambientes::find($id)) {
                $ambiente = Ambientes::find($id);
                return response()->json($ambiente, 200);
            } else {
                return response()->json([
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
            if (Ambientes::find($id)) {
                $request->validate([
                    'nombre_amb' => 'string',
                    'fk_municipio' => 'integer',
                    'sede' => 'integer',
                    'estado' => 'integer'
                ]);

                $ambiente = Ambientes::findOrFail($id)->update($request->all());
                if ($ambiente) {
                    return response()->json(Ambientes::find($id), 201);
                } else {
                    return response()->json([
                        'message' => 'input error data'
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'id not found'
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
            if (Ambientes::find($id)) {
                Ambientes::destroy($id);
                return response()->json([
                    'message' => 'deleted success'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'id not found'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json($e, 404);
        }
    }
}
