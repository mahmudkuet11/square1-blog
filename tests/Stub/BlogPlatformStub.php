<?php

namespace Tests\Stub;

use App\Contracts\BlogPlatform;
use Faker\Generator as Faker;

class BlogPlatformStub implements BlogPlatform
{
    /**
     * @var Generator
     */
    protected $faker;

    function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function fetchNewPosts()
    {
        return [
            'data' => [
                [
                    'title' => 'Title 1',
                    'description' => 'Description 1',
                    'publication_date' => '2022-01-08 10:09:38',
                ],
                [
                    'title' => 'Title 2',
                    'description' => 'Description 2',
                    'publication_date' => '2022-01-09 10:09:38',
                ]
            ]
        ];
    }
}
