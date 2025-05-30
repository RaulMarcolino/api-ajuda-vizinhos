<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpRequest;

class HelpRequestController extends Controller
{
    public function index()
    {
        return HelpRequest::with('user')->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $helpRequest = HelpRequest::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($helpRequest, 201);
    }

    public function show($id)
    {
        return HelpRequest::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $helpRequest = HelpRequest::findOrFail($id);
        $this->authorize('update', $helpRequest);

        $helpRequest->update($request->only(['title', 'description']));

        return response()->json($helpRequest);
    }

    public function destroy($id)
    {
        $helpRequest = HelpRequest::findOrFail($id);
        $this->authorize('delete', $helpRequest);

        $helpRequest->delete();

        return response()->json(null, 204);
    }
}