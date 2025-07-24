<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Game::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'ILIKE', "%$search%")
                  ->orWhere('genre', 'ILIKE', "%$search%");
        }
        $games = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'release_date' => 'nullable|date',
            'image' => 'nullable|file',
        ]);
        $game = Game::create($data);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $game->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/games'), $filename);
            GameImage::create([
                'game_id' => $game->id,
                'image' => 'games/' . $filename,
            ]);
        }
        return redirect()->route('games.index')->with('success', 'Game cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);
        $images = $game->images;
        return view('games.show', compact('game', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $images = $game->images;
        return view('games.edit', compact('game', 'images'));
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
        $game = Game::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'release_date' => 'nullable|date',
            'image' => 'nullable|file',
        ]);
        $game->update($data);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $game->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/games'), $filename);
            GameImage::create([
                'game_id' => $game->id,
                'image' => 'games/' . $filename,
            ]);
        }
        return redirect()->route('games.index')->with('success', 'Game atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        // Remove todas as imagens relacionadas
        foreach ($game->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game excluído com sucesso!');
    }
}
