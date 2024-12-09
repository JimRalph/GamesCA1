<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all();
        return view("games.index", compact("games"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin'){
            return redirect()->route('games.index')->with('error', 'Access Denied');
        }
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate input
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'release_date' => 'required|date',
            'age_restriction' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        //check if the image is uploaded and handle it
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/games'), $imageName);
        }

        //Create a new game record in the database
        Game::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'age_restriction' => $request->age_restriction,
            'image' => $request->$imageName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return to_route('games.index')->with('success', 'Game created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        $game->load('reviews.user');
        return view('games.show')->with('game', $game);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit', [
            'game' => $game,
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'developer_id' => 'required|integer|exists:developers,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:500',
            'age_restriction' => 'required|integer|min:0|max:18',
            'release_date' => 'required|date',
            'updated_at' => now()
        ]);
    
        // Handle new image and delete old one
        if ($request->hasFile('image')) {
            // Delete old image
            if ($game->image && Storage::exists($game->image)) {
                Storage::delete($game->image);
            }
            // Store the new image
            $game->image = $request->file('image')->store('public/images/games');
        }

        // Fill the game with validated data
        $game->fill($validated);
    
        // Save the game
        $game->save();
    
        // Redirect back to the index
        return redirect()->route('games.index')->with('success', 'Game updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game has been successfully deleted');
    }

}
