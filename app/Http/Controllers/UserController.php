<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('welcome', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',],
         [
                'name.required' => 'O campo nome é obrigatório',
                'email.required' => 'O campo email é obrigatório',
                'email.email' => 'O email deve ser um endereço de email válido',
                'email.unique' => 'O email já existe',
                'phone.required' => 'O campo telefone é obrigatório',
                'phone.max' => 'O número de telefone não pode exceder 20 caracteres',
            ]);

            $user = User::create($validatedData);
            return response()->json(['message' => 'Usuario criado com sucesso', 'data' => $user], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'phone' => 'required|string|max:20',
            ], [
                'name.required' => 'O campo nome é obrigatório',
                'email.required' => 'O campo email é obrigatório',
                'email.email' => 'O email deve ser um endereço de email válido',
                'email.unique' => 'O email já existe',
                'phone.required' => 'O campo telefone é obrigatório',
                'phone.max' => 'O número de telefone não pode exceder 20 caracteres',
            ]);

            if (!$user)
            {
                return response()->json(['message' => 'Usuario nao encontrado'], 404);
            }

            $user->update($validatedData);
            return response()->json(['message' => 'Usuario atualizado com sucesso', 'data' => $user], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Erro ao atualizado usuario', 'error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try
        {
            $user = User::findOrFail($id);

            if(!$user) {
                return response()->json(['message' => 'Usuario nao encontrado'], 404);
            }

            $user->delete();
            return response()->json(['message' => 'Usuario deletado com sucesso'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Erro ao deletar usuario', 'error' => $e->getMessage()], 500);
        }
    }
}
