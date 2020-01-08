<?php

namespace App\Contracts;

/**
 * Interface BaseContract
 * @package App\Contracts
 */

interface BaseContract
{
    /**
     * Create a model Instance
     * @param array $attributes
     * @return mixed
     */

    public function create(array $attributes);

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */

    public function update(array $attributes, int $id);

    /**
     * Return all model rows
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */

    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    /**
     * Find one by ID
     * @param init $id
     * @return mixed
     */

    public function find(int $id);

    /**
     * Find one by ID of throw exception
     * @param int $id
     * @return mixed
     */

    public function findOneOrFail(int $id);

    /**
     * Find based on a different column
     * @param array $data
     * @return mixed
     */

    public function findBy(array $data);

    /**
     * Find based on a different column
     * @param array $data
     * @return mixed
     */

    public function findOneby(array $data);


    /**
     * Find one based on a different column or throw exception
     * @param array $data
     * @return mixed
     */

    public function findOneByOrFail(array $data);

    /**
     * Delete one by ID
     * @param int $id
     * @return mixed
     */

    public function delete(int $id);
}
