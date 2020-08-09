<?php

namespace App\Http\Controllers;

use App\Http\Resources\TravelDateResource;
use App\Models\Travel;
use App\Models\TravelDate;
use Illuminate\Http\Request;

class TravelDateController extends Controller
{
  public function index(Travel $travel)
  {
    $query = $travel->travelDates();
    return TravelDateResource::collection($query->paginate());
  }

  public function store(Request $request, Travel $travel)
  {
    return $travel->travelDates()->create([
      'start_date' => $request->input('start_date'),
      'end_date' => $request->input('end_date'),
      'reservation' => $request->input('reservation'),
    ]);
  }


  public function update(Request $request, TravelDate $travelDate)
  {
    $travelDate->update([
      'start_date' => $request->input('start_date'),
      'end_date' => $request->input('end_date'),
      'reservation' => $request->input('reservation'),
    ]);
    return $travelDate;
  }

  public function show(TravelDate $travelDate)
  {
    return $travelDate;
  }

  public function destroy(TravelDate $travelDate)
  {
    $travelDate->delete();
    return $travelDate;
  }
}
