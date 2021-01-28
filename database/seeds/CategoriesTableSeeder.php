<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 5; $i++) {
        $new_category = new Category();
        $new_category->name = $faker->words(3, true);
        // genero lo slug
        $slug = Str::slug($new_category->name);
        $slugBase = $slug;
        // verifico che lo slag non sia presente nel database
        $categoriaPresente =  Category::where('slug', $slug)->first();
        $contatore = 1;
        // entro nel ciclo se trovo un posto con lo stesso slug
        while ($categoriaPresente) {
          // genero uno slag aggiungengo un contatore
          $slug = $slugBase . '-' . $contatore;
          $contatore++;
          $categoriaPresente =  Post::where('slug', $slug)->first();
        }
        // se esco dal ciclo so che lo slug non è già presente nel db
        // assegno lo slug al nuovo post
        $new_category->slug = $slug;
        $new_category->save();

      }
    }
}
