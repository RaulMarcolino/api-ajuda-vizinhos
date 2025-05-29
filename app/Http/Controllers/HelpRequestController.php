<?php

namespace App\Http\Controllers;

use App\Models\HelpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelpRequestController extends Controller
{
    public function __construct()
    {
        // Protege as rotas com autenticação Sanctum
        $this->middleware('auth:sanctum');
    }

    // Criar uma nova solicitação de ajuda
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $helpRequest = HelpRequest::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
        ]);

        return response()->json([
            'message' => 'Solicitação de ajuda criada com sucesso',
            'helpRequest' => $helpRequest,
        ], 201);
    }

    // Listar todas as solicitações de ajuda
    public function index()
    {
        $helpRequests = HelpRequest::all();

        return response()->json($helpRequests);
    }
}