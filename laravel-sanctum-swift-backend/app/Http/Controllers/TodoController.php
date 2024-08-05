<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // 認証ミドルウェアを適用
    }

    public function index()
    {
        $user = Auth::user();
        return response()->json($user->todos); // 認証されたユーザーのTODOリストを返す
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $todo = $user->todos()->create([
            'title' => $request->title,
        ]);

        return response()->json($todo, 201);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $todo = $user->todos()->find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        $todo->delete();
        return response()->json(null, 200);
    }
}
