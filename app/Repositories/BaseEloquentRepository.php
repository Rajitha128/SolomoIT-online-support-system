<?php namespace App\Repositories;

class BaseEloquentRepository {

    protected $model;

    protected $order = null;

    protected $dateParams = array('from' => null,'to' => null);

	/**
	 * Find the model given an ID
	 * @param $id
	 * @return mixed
	 */
	public function find($id) {
		return $this->model->find($id);
    }

    	/**
	 * Find the model given an ID
	 * @param $id
	 * @return mixed
	 */
	public function findOrFail($id) {
		return $this->model->findOrFail($id);
	}

	/**
	 * Find all models
	 * @return mixed
	 */
	public function findAll() {
		return $this->model->all();
	}

    /**
     * @param array $relations Relation to eager load
     * @param int $paginate
     * @return mixed
     */
    public function findAllPaginated($relations = array(), $paginate = 5)
    {
        $model = $this->model;
        if($this->order != null) {
            $model = $model->orderBy($this->order[0], $this->order[1]);
        }

        //eager load relations
        foreach($relations as $relation) {
            $model->with($relation);
        }

        return $model->paginate($paginate);
    }

	/**
	 * Create
	 * @param $data
	 * @return mixed
	 */
	public function create($data) {
        return $this->model->create($data);
	}

    public function findBy($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    public function getBy($column, $value)
    {
        return $this->model->where($column, $value)->paginate();
    }
}
