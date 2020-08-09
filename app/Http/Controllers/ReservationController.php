<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\TravelDate;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = auth()->user();
        $query = $user->reservations();
        return ReservationResource::collection($query->paginate());
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param TravelDate $travelDate
   * @return void
   */
    public function store(Request $request, TravelDate $travelDate)
    {
        $user = auth()->user();
        return $user->reservations()->create([
          'quantity' => $request->input('quantity'),
          'travel_date_id' => $travelDate->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return ReservationResource
     */
    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return Reservation
     */
    public function update(Request $request, Reservation $reservation)
    {
      $reservation->update([
        'quantity' => $request->input('quantity'),
      ]);
      return $reservation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return Reservation
     */
    public function destroy(Reservation $reservation)
    {
      $reservation->delete();
      return $reservation;
    }
}
