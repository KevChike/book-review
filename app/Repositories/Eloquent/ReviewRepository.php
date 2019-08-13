<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\ReviewRepositoryInterface;

class ReviewRepository extends Repository implements ReviewRepositoryInterface
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Review';
    }
}
