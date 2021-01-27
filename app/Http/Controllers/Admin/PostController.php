<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = [
        'posts' => Post::all()
      ];
      return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();

      $newPost = new Post();
      $newPost->fill($data);
      // genero lo slug
      $slug = Str::slug($newPost->title);
      $slugBase = $slug;
      // verifico che lo slag non sia presente nel database
      $postPresente =  Post::where('slug', $slug)->first();
      $contatore = 1;
      // entro nel ciclo se trovo un posto con lo stesso slug
      while ($postPresente) {
        // genero uno slag aggiungengo un contatore
        $slug = $slugBase . '-' . $contatore;
        $contatore++;
        $postPresente =  Post::where('slug', $slug)->first();
      }
      // se esco dal ciclo so che lo slug non è già presente nel db
      // assegno lo slug al nuovo post
      $newPost->slug = $slug;
      $newPost->save();

      return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      if ($post) {
        $data = [
          'post' => $post
        ];
        return view('admin.posts.show', $data);
      }
      abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      if ($post) {
        $data = [
          'post' => $post
        ];
        return view('admin.posts.edit', $data);
      }

      abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $form_data = $request->all();
      // se il titolo viene modificato allora modifico pure lo Slug
      if ($form_data['title'] != $post->title) {
        // il titolo è stato modificato quindi modifico lo slug
        // genero lo slug
        $slug = Str::slug($form_data['title']);
        $slugBase = $slug;
        // verifico che lo slag non sia presente nel database
        $postPresente =  Post::where('slug', $slug)->first();
        $contatore = 1;
        // entro nel ciclo se trovo un posto con lo stesso slug
        while ($postPresente) {
          // genero uno slag aggiungengo un contatore
          $slug = $slugBase . '-' . $contatore;
          $contatore++;
          $postPresente =  Post::where('slug', $slug)->first();
        }
        // se esco dal ciclo so che lo slug non è già presente nel db
        // assegno lo slug al nuovo post
        $form_data['title'] = $slug;
      }
      // uso la funzione update per modificare i dati
      $post->update($form_data);
      return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      $post->delete();
      return redirect()->route('admin.posts.index');
    }
}
