<?php

namespace App\Model;

class PostsModel extends Model
{


	public function getPosts(int $topicId, int $pageStart, int $rowsPerPage): array
	{
		$posts = $this->findBy(['topicId' => $topicId, 'id >' => $pageStart])->limit($rowsPerPage)->fetchAll();
		return $posts;
	}

}
