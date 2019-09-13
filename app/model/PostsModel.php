<?php

namespace App\Model;

class PostsModel extends Model
{


	/**
	 * <b>getPosts()</b> has three parameters which determine what kind of data is fetched.<br>
	 * The reason for the parameters is to be able to load posts in a lazy manner. <br>
	 * Loading 100 posts per page instead of 1 000+ every time. <br>
	 * - <b>$topicId</b> : finds posts under a specific topic, e.g. General, Music
	 * - <b>$postStart</b> : id of the starting row from which posts should be shown, meaning <b>if $postStart = 155 then getPosts will get posts with id > 155</b><br>
	 * <b>!beware!</b> if you want to start from post 100 INCLUDING the 100th post, use $postStart = 99.
	 * - <b>$rowsPerPage</b> : the amount of rows to be shown
	 * <b>Example</b>:
	 * Show 20 posts starting from post with id of 100 (including the post with id = 100), the topic is General (which is 1) -> <b>getPosts(1, 99, 20)</b><br>
	 *
	 * @param int $topicId topic of the posts, e.g. General
	 * @param int $postStart id of the starting post, e.g. 99 (meaning the first post will be 100)
	 * @param int $rowsPerPage amount of rows to be fetched, e.g. used when each page is to have 20 posts only
	 * @return array
	 */
	public function getPosts(int $topicId, int $postStart, int $rowsPerPage): array
	{
		$posts = $this->findBy(['topicId' => $topicId, 'id >' => $postStart], 'deactivated is NULL')->limit($rowsPerPage)->fetchAll();
		return $posts;
	}

}
