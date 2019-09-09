<?php

namespace App\Model;

class PostsModel extends Model
{


	public function getPosts(int $pageStart, int $pageStop): array
	{
		$posts = $this->connection->findBy(['id >=' => $pageStart, 'id <' => $pageStop])->fetchAll();
		return $posts;
	}

}
