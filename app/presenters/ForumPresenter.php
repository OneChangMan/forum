<?php

namespace App\Presenters;

use App\Forms;
use Nette\Application\UI\Form;
use App\Model\PostsModel;

class ForumPresenter extends ForumSecuredPresenter
{

	/** @var Forms\NewPostFormFactory */
	private $newPostFactory;

	/** @var PostsModel @inject */
	public $postsModel;

	/** @var \App\Model\TopicsModel @inject */
	public $topicsModel;


	public function __construct(Forms\NewPostFormFactory $newPostFactory)
	{
		$this->newPostFactory = $newPostFactory;
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


	public function actionNewPost()
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
		bdump($id);
	}


	private function getTopics(int $pageStart, int $pageStop): array
	{
		$posts = $this->postsModel->findBy(['id >=' => $pageStart, 'id <' => $pageStop])->fetchAll();
		return $posts;
	}


	private function getPosts(int $pageStart, int $pageStop): array
	{
		$posts = $this->postsModel->findBy(['id >=' => $pageStart, 'id <' => $pageStop])->fetchAll();
		return $posts;
	}


	public function actionLogOut()
	{
		$this->user->logout();
		$this->flashMessage("You've been successfully logged out! Have a great day.");
		$this->redirect('Homepage:');
	}

}
