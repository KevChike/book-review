<?php

namespace App\Contracts\Repositories;

interface RepositoryInterface
{
    /**
     * Fetch all record from database with the option of filtering the columns
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = array('*'));

    /**
     * Fetch all record from database with the option
     * of filtering the columns and paginating the record
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate(int $perPage = 0, array $columns = array('*'));

    /**
     * Create a record in the database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update a record in the database
     *
     * @param string $uid
     * @param array $data
     * @param string $attribute
     * @return mixed
     */
    public function update(string $uid, array $data, string $attribute);

    /**
     * Delete a record in the database
     *
     * @param string $uid
     * @param string $attribute
     * @return mixed
     */
    public function delete(string $uid, string $attribute);

    /**
     * Find a single record in the database with the option of filtering
     * the columns to be viewed
     *
     * @param string $uid
     * @param array $columns
     * @return mixed
     */
    public function find(string $uid, array $columns = array('*'));

}
