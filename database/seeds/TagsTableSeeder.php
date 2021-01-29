<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 5; $i++) {
        $new_tag = new Tag();
        $new_tag->name = $faker->words(3, true);
        // genero lo slug
        $slug = Str::slug($new_tag->name);
        $slugBase = $slug;
        // verifico che lo slag non sia presente nel database
        $tagPresente =  Tag::where('slug', $slug)->first();
        $contatore = 1;
        // entro nel ciclo se trovo un posto con lo stesso slug
        while ($tagPresente) {
          // genero uno slag aggiungengo un contatore
          $slug = $slugBase . '-' . $contatore;
          $contatore++;
          $tagPresente =  Post::where('slug', $slug)->first();
        }
        // se esco dal ciclo so che lo slug non è già presente nel db
        // assegno lo slug al nuovo post
        $new_tag->slug = $slug;
        $new_tag->save();
      }
    }
}
