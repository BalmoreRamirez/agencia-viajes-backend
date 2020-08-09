<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Models\Agency;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param Agency $agency
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function index(Agency $agency)
  {
    $query = $agency->ratings();
    return RatingResource::collection($query->paginate());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param Agency $agency
   * @return \Illuminate\Database\Eloquent\Model
   */
    public function store(Request $request, Agency $agency)
    {
      return $agency->ratings()->create([
        'rating' => $request->input('rating')
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return Rating
     */
    public function show(Rating $rating)
    {
        return $rating;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return Rating
     */
    public function update(Request $request, Rating $rating)
    {
      $rating->update([
        'rating' => $request->input('rating')
      ]);
      return $rating;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return Rating
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();
        return $rating;
    }
}
