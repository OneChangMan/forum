<?php

namespace App\Model;

class Model extends BaseModel
{


	public function add($values)
	{
		return $this->getTable()->insert($values);
	}


	public function delete($id)
	{
		$this->findById($id)->delete();
	}


	public function update($id, $values)
	{
		return $this->findById($id)->update($values);
	}


	public function findByUser($userId)
	{
		return $this->findBy(['user_id' => $userId]);
	}

}
