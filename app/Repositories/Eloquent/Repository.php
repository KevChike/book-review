<?php

namespace App\Repositories\Eloquent;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Contracts\Repositories\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    /**
     * The current globally available container
     *
     * @var \Illuminate\Container\Container
     */
    private $app;

    /**
     * The instance of the model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The default column used for searching a table
     *
     * @var string
     */
    protected $defaultAttribute = 'id';

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();

    /**
     * Fetch all record from database with the option of filtering the columns
     *
     * @param  array $columns
     * @return mixed
     */
    public function all(array $columns = array('*'))
    {
        return $this->model->latest()->get($columns);
    }

    /**
     * Fetch all record from database with the option
     * of filtering the columns and paginating the record
     *
     * @param  int $perPage
     * @param  array $columns
     * @return mixed
     */
    public function paginate(int $perPage = 0, array $columns = array('*'))
    {
        return $this->model->latest()->paginate($perPage, $columns);
    }

    /**
     * Create a record in the database
     *
     * @param  array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a record in the database
     *
     * @param  string $uid
     * @param  array $data
     * @param  string $attribute
     * @return mixed
     */
    public function update(string $uid, array $data, string $attribute = '')
    {
        $attribute = ($attribute == '') ? $this->defaultAttribute : $attribute;

        $data = array_except($data, ['_token', '_method']);
        
        return $this->model->where($attribute, $uid)->firstOrFail()->update($data);
    }

    /**
     * Delete a record in the database
     *
     * @param  string $uid
     * @return mixed
     */
    public function delete(string $uid, string $attribute = '')
    {
        $attribute = ($attribute == '') ? $this->defaultAttribute : $attribute;
        
        return $this->model->where($attribute, $uid)->firstOrFail()->delete();
    }

    /**
     * Find a single record in the database with the option of filtering
     * the columns to be viewed
     *
     * @param  string $uid
     * @param  array $columns
     * @return mixed
     */
    public function find(string $uid, array $columns = array('*'))
    {
        return $this->model->where($this->defaultAttribute, $uid)->firstOrFail($columns);
    }

    /**
     * Get model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }
}
