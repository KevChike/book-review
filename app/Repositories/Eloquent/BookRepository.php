<?php

namespace App\Repositories\Eloquent;

use DB;
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

    /**
     * Fetch all record from database with the option of filtering the columns
     *
     * @param  array $columns
     * @return mixed
     */
    public function all(array $columns = array('*'))
    {
    	return $this->model->latest()
    				->with(['reviews:rating,book_id'])
    				->get($columns);
    }
}
