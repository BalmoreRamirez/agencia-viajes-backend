<?php

namespace App\Http\Controllers;

use App\Http\Resources\NetworkResource;
use App\Models\Network;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    protected $network;

    public function __construct(Network $network)
    {
        $this->network = $network;
    }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
      $agency = auth()->user()->agency()->first();

      $query = $agency->networks();
        return NetworkResource::collection($query->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agency = auth()->user()->agency()->first();
        return $agency->networks()->create([
          'url' => $request->input('url'),
          'name' => $request->input('name'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Network  $network
     * @return Network
     */
    public function show(Network $network)
    {
        return $network;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Network  $network
     * @return Network
     */
    public function update(Request $request, Network $network)
    {
      $network->update([
        'url' => $request->input('url'),
        'name' => $request->input('name'),
      ]);
      return $network;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Network  $network
     * @return Network
     */
    public function destroy(Network $network)
    {
        $network->delete();
        return $network;
    }
}
