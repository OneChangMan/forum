<?php

namespace App\Presenters;

use App\Forms;
use Nette\Application\UI\Form;

class ForumPresenter extends ForumSecuredPresenter
{

	/** @var Forms\AddCommentFormFactory */
	private $addCommentFactory;

	/** @var Forms\NewPostFormFactory */
	private $newPostFactory;

	/** @var \App\Model\PostsModel @inject */
	public $postsModel;

	/** @var \App\Model\TopicsModel @inject */
	public $topicsModel;

	/** @var \App\Model\CommentsModel @inject */
	public $commentsModel;

	/** @var \App\Model\UsersModel @inject */
	public $usersModel;

	/** @var integer */
	private $postId;


	public function __construct(Forms\NewPostFormFactory $newPostFactory, Forms\AddCommentFormFactory $addCommentFactory)
	{
		$this->newPostFactory = $newPostFactory;
		$this->addCommentFactory = $addCommentFactory;
	}


	public function actionDefault(): void
	{
		$this->template->topics = $this->topicsModel->getTopics();
		$this->template->topicCount = $this->template->topics->count();
		$this->template->isAdmin = $this->isAdmin();
	}


	protected function isAdmin(): bool
	{
		$adminRoleId = 1;
		foreach ($this->user->roles as $role) {
			if ($role === $adminRoleId) {
				return true;
			}
		}
		return false;
	}


	public function actionNewPost(): void
	{

	}


	protected function createComponentNewPostForm(): form
	{
		return $this->newPostFactory->create(function () {
				$this->redirect('Forum:');
			});
	}


	public function actionViewPost(int $topicId): void
	{
		$startingRow = 0;
		$rowsToShow = 10;
		$posts = $this->postsModel->getPosts($topicId, $startingRow, $rowsToShow);

		$this->template->postCount = count($posts);
		$this->template->posts = $posts;

		$topic = $this->topicsModel->findById($topicId);
		$this->template->topic = $topic->topic;
	}


	public function actionLogOut(): void
	{
		$this->user->logout();
		$this->flashMessage("You've been successfully logged out! Have a great day.");
		$this->redirect('Homepage:');
	}


	public function actionViewComments(int $postId): void
	{
		$this->postId = $postId;
		$post = $this->postsModel->findById($postId);
		$this->template->post = $post;
		$this->template->postAuthor = $this->usersModel->getUser($post->uid);

		$commentsArray = [];
		$comments = $this->commentsModel->getComments($postId);
		foreach ($comments as $comment) {
			$user = $this->usersModel->getUser($comment->userId);
			if ($user) {
				$commentsArray[$user->username] = $comment;
			}
		}
		$this->template->comments = $commentsArray;
	}


	protected function createComponentAddCommentForm(): form
	{
		return $this->addCommentFactory
				->setPostId($this->postId)
				->create(function () {
					$this->redirect('this');
				});
	}

}
