<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 100; $i++) {
        $newPost = new Post();
        $newPost->title = $faker->sentence();
        $newPost->content = $faker->text(500);
        // creo lo slug
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
      }
    }
}
