<?php

namespace App\Model;

class CommentsModel extends Model
{
	public function getComments(int $postId, int $pageStart, int $rowsPerPage): array
	{
		//$comments = $this->findBy(['pid' => $postId, 'id >' => $pageStart], 'deactivated is NULL')->limit($rowsPerPage)->fetchAll();
		$comments = $this->findBy(['deactivated IS NULL', 'pid' => $postId,])->fetchAll();
		
		return $comments;
	}

}
