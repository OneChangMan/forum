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
		foreach ($this->user->roles as $role) {
			if ($role === 1) {
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


	public function actionViewPost(int $id): void
	{
		$topic = $this->topicsModel->findById($id);
		$this->template->topic = $topic->topic;

		$posts = $this->postsModel->getPosts($id, 0, 10);

		$this->template->postCount = count($posts);
		$this->template->posts = $posts;
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
		$comments = $this->commentsModel->getComments($postId, 0, 10);
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
