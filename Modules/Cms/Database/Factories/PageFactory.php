<?php

namespace Modules\Cms\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Cms\Entities\Page;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => substr($this->faker->text(30), 0, -1),
            'slug'              => '',
            'intro'             => $this->faker->paragraph,
            'content'           => $this->faker->paragraphs(rand(5, 7), true),
            'is_featured'       => $this->faker->randomElement([1, 0]),
            'featured_image'    => 'https://picsum.photos/1200/630',
            'status'            => 1,
            'meta_title'        => '',
            'meta_keywords'     => '',
            'meta_description'  => '',
            'meta_og_image'     => '',
            'meta_og_url'       => '',
            'created_by_name'   => '',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'published_at'      => Carbon::now(),
        ];
    }
}
