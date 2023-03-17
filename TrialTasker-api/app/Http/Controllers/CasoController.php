<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use Illuminate\Http\Request;

class CasoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cases = Caso::orderBy('id', 'desc')->paginate(10);
        // $cases->load('users','persons');
        return response()->json($cases, 200);
    }

    public function all()
    {
        $cases = Caso::orderBy('id', 'desc');
        return response()->json($cases, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'case_name' => ['required', 'string'],
                'case_radicate' => ['required', 'string'],
                'case_status' => ['required', 'bool'],
                'case_user_id' => ['required', 'integer'],
                'case_person_id' => ['required', 'integer'],
            ]);

            $caso = Caso::create([
                'case_name' => $request->case_name,
                'case_radicate' => $request->case_radicate,
                'case_status' => $request->case_status,
                'case_user_id' => $request->case_user_id,
                'case_person_id' => $request->case_person_id,
            ]);
            return response()->json(['message' => 'Caso creado correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cases = Caso::find($id);
        return response()->json($cases);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $cases = Caso::findOrFail($id);

            $request->validate([
                'case_name' => ['required', 'string'],
                'case_radicate' => ['required', 'string'],
                'case_status' => ['required', 'bool'],
                'case_user_id' => ['required', 'integer'],
                'case_person_id' => ['required', 'integer'],
            ]);

            Caso::find($id)->update([
                'case_name' => $request->case_name,
                'case_radicate' => $request->case_radicate,
                'case_status' => $request->case_status,
                'case_user_id' => $request->case_user_id,
                'case_person_id' => $request->case_person_id,
            ]);

            return response()->json(['message' => 'Caso actualizado correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["errors" => $e->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Caso::find($id)->delete();
        return response()->json(['message' => 'Caso eliminado exitosamente'], 201);
    }
}