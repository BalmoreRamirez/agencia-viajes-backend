<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Http\Resources\TravelResource;
use App\Models\Reservation;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = auth()->user();
        $agency = $user->agency()->first();
        $query = $agency->travels();
        return TravelResource::collection($query->paginate());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = auth()->user();
      $agency = $user->agency()->first();
      $travel = $agency->travels()->create([
        'title' => $request->input('title'),
        'start_place' => $request->input('start_place'),
        'available' => $request->input('available'),
        'price' => $request->input('price'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'limit_date' => $request->input('limit_date'),
        'description' => $request->input('description'),
      ]);

      $images = $request->input('images');
      if(count($images) > 0) {
        foreach ($images as $image) {
          $travel->images()->create([
            'url' => $image['url']
          ]);
        }
      }

      return $travel;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return TravelResource
     */
    public function show(Travel $travel)
    {
        return new TravelResource($travel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return Travel
     */
    public function update(Request $request, Travel $travel)
    {
      $travel->update([
        'title' => $request->input('title'),
        'start_place' => $request->input('start_place'),
        'available' => $request->input('available'),
        'price' => $request->input('price'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'limit_date' => $request->input('limit_date'),
      ]);

      $images = $request->input('images');
      if(count($images) > 0) {
        $travel->images()->delete();
        foreach ($images as $image) {
          $travel->images()->create([
            'url' => $image['url']
          ]);
        }
      }
      return $travel;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return Travel
     */
    public function destroy(Travel $travel)
    {
        $travel->delete();
        return $travel;
    }

  public function reservations(Travel $travel)
  {
    $reservations = Reservation::FindReservations($travel);

    return ReservationResource::collection($reservations->paginate());
  }

  public function published(Travel $travel)
  {
    $query = Travel::latest();

    return TravelResource::collection($query->paginate());
  }

}
