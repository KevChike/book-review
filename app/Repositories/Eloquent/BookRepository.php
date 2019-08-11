<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\BookRepositoryInterface;

class BookRepository extends Repository implements BookRepositoryInterface
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Book';
    }
}
