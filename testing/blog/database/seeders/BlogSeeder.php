<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::factory()
            ->count(20)
            ->create();
        // Blog::create([
        //     "title" => "Cats vs dogs",
        //     "body" => "lorem100  Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum aliquid voluptas reiciendis totam quod architecto vitae doloremque magnam nisi laboriosam eveniet impedit sapiente iste, exercitationem nesciunt. Nihil itaque minima, beatae possimus inventore id, praesentium voluptas omnis, vel modi at laudantium maxime voluptate voluptates officia facere distinctio ex voluptatum culpa rem reiciendis a facilis dolores sint? Inventore incidunt neque eligendi nobis ad soluta in voluptatibus cumque tempore. Voluptates suscipit esse neque numquam obcaecati cupiditate. Fugit cum sequi sit dolore similique, illum beatae totam quia adipisci minus iste, deleniti eaque, ipsam accusamus nostrum distinctio magni mollitia veritatis doloribus repudiandae at quos possimus?",
        //     "slug" => "cats-vs-dogs",
        //     "created_at" => "2021-11-29 00:00:00",
        //     "updated_at" => "2021-11-29 00:00:00",
        //     "author" => "Nika Gabisonia"
        // ]);
    }
}