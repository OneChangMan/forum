<?php

namespace App\Model;

class UsersModel extends Model
{


	public function getUser(int $id): ?\Nette\Database\Table\ActiveRow
	{
		$user = $this->findById($id);
		return $user ?: NULL;
	}

}
