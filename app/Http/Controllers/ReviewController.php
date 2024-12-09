<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Game $game)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $game->reviews()->create([
            'user_id'=>auth()->id(),
            'rating'=>$request->input('rating'),
            'comment'=>$request->input('comment'),
            'game_id'=>$game->id,
        ]);

        return redirect()->route('games.show, $game')->with('success', 'review added succesffully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //check if user is an admin
        if (auth()->user()->id !== $review->user_id && auth()->user()->role !== 'admin'){
            return redirect()->route('games.index')->with('error', 'Access Denied');
        }
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {

                //check if user is an admin
        if (auth()->user()->id !== $review->user_id && auth()->user()->role !== 'admin'){
            return redirect()->route('games.index')->with('error', 'Access Denied');
        }
        //check to ensure the user is authorised to update this review
        $review->update($request->only(['rating', 'comment']));
        //once the review is updated, redirecct to the games.show
        return redirect()->route('games.show', $review->game_id)
                        ->with('success', 'Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
