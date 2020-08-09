<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgencyResource;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{

  protected $agency;

  public function __construct(Agency $agency)
  {
    $this->agency = $agency;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $query = $this->agency;
    return AgencyResource::collection($query->paginate());
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $user = auth()->user();
    return $user->agency()->create([
      'name' => $request->input('name'),
      'logo' => $request->input('logo'),
      'address' => $request->input('address'),
      'phone_number' => $request->input('phone_number'),
      'mobile_number' => $request->input('mobile_number'),
      'email' => $request->input('email'),
      'description' => $request->input('description'),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param Agency $agency
   * @return \App\Agency|Agency
   */
  public function show(Agency $agency)
  {
    return $agency;
  }


  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Agency $agency
   * @return \App\Agency|Agency
   */
  public function update(Request $request, Agency $agency)
  {
    $agency->update([
      'name' => $request->input('name'),
      'logo' => $request->input('logo'),
      'address' => $request->input('address'),
      'phone_number' => $request->input('phone_number'),
      'mobile_number' => $request->input('mobile_number'),
      'email' => $request->input('email'),
      'description' => $request->input('description'),
    ]);
    return $agency;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Agency $agency
   * @return \App\Agency|Agency
   * @throws \Exception
   */
  public function destroy(Agency $agency)
  {
    $agency->delete();
    return $agency;
  }
}
