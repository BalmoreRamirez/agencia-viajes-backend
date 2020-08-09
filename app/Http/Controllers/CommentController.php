<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Agency;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param Agency $agency
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
    public function index(Agency $agency)
    {
      $query = $agency->comments();
      return CommentResource::collection($query->paginate());
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
      return $agency->comments()->create([
        'comment' => $request->input('comment')
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return Comment
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return Comment
     */
    public function update(Request $request, Comment $comment)
    {
      $comment->update([
        'comment' => $request->input('comment')
      ]);
      return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return Comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return $comment;
    }
}
