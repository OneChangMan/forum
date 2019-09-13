<?php

namespace App\Model;

class CommentsModel extends Model
{
	/**
	 * TBD: Lazy load comments using rowsPerPage and commentStart (the same structure as in getPosts() in model/PostsModel)
	 */
	public function getComments(int $postId): array
	{
		//$comments = $this->findBy(['pid' => $postId, 'id >' => $pageStart], 'deactivated is NULL')->limit($rowsPerPage)->fetchAll();
		$comments = $this->findBy(['deactivated IS NULL', 'pid' => $postId,])->fetchAll();

		return $comments;
	}

}
