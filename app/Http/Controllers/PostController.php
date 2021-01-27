<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  public function index() {
    $data = [
      'posts' => Post::all()
    ];
    return view('guest.posts.index', $data);
  }

  public function show($slug) {
    // non usando più l'id per trovare il post
    // creo un where per ricavare il post con lo slug giusto
    $post = Post::where('slug', $slug)->first();
    if ($post) {
      $data = [
        'post' => $post
      ];
      return view('guest.posts.show', $data);
    }
    abort(404);
  }
}
