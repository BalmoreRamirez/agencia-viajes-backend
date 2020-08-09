<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteAgencyResource;
use App\Http\Resources\FavoriteTravelResource;
use App\Http\Resources\UserResource;
use App\Models\Agency;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\Store as StoreRequest;
use App\Http\Requests\Users\Update as UpdateRequest;
use Illuminate\Support\Str;

class UserController extends Controller
{
  /**
   * @var
   */
  protected $user;

  /**
   * @param User $user
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  /**
   * Display a listing of the resource.
   *
   * @param Request $request
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function index(Request $request)
  {
    return UserResource::collection($this
      ->user
      ->latest()
      ->paginate($request->input('per_page'))
    );
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request)
  {
    // $password = 123456;Str::random(8);
    return (new $this->user)->create([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'is_agency' => $request->input('is_agency'),
      'password' => $request->input('password'),
      'birth_date' => $request->input('birth_date'),
      'last_name' => $request->input('last_name'),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param User $user
   * @return User
   */
  public function show(User $user)
  {
    return $user;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param UpdateRequest $request
   * @param User $user
   * @return User
   */
  public function update(UpdateRequest $request, User $user)
  {
    $user->update([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'birth_date' => $request->input('birth_date'),
      'last_name' => $request->input('last_name'),
    ]);
    return $user;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    try {
      $user->delete();
    } catch (\Exception $exception) {
      return response([
        'message' => 'Cannot delete this user',
        'exception' => $exception->getMessage(),
      ]);
    }
    return $user;
  }

  public function storeFavoriteAgency(Travel $travel)
  {
    $user = auth()->user();
    if($user->favoriteTravels()->IsNewRecord($travel)) {
      $favorite = $user->favoriteTravels()->create([
        'travel_id' => $travel->id
      ]);
    } else {
      $favorite = $user->favoriteTravels()->RemoveRecord($travel);
    }

    return $travel;
  }

  public function indexFavoriteAgency()
  {
    $query = auth()->user()->favoriteTravels();
    return FavoriteTravelResource::collection($query->paginate());
  }

  public function me()
  {
    return auth()->user()->load('agency');
  }
}
