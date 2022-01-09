<?php

namespace App\Contracts;

interface BlogPlatform{
    /**
     * @return array
     */
    public function fetchNewPosts();
}