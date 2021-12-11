<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Http\Resources\BoardResource;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::with(['board_type', 'user'])->get();

        return BoardResource::collection($boards);
    }

    public function show(Board $board)
    {
        return new BoardResource($board);
    }

    public function store(Request $request)
    {
        $board = Board::create($request->all());

        return new BoardResource($board);
    }

    public function update(Request $request, Board $board)
    {
        $board->update($request->all());

        return new BoardResource($board);
    }

    public function destroy(Board $board)
    {
        $board->delete();

        return response()->json([], 204);
    }

    public function kudos(Request $request, Board $board)
    {
        $kudo = $board->kudos()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return response()->json([
          'message' => 'Kudo created successfully',
        ], 201);
    }
}
