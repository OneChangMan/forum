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


	public function __construct(Forms\NewPostFormFactory $newPostFactory)
	{
		$this->newPostFactory = $newPostFactory;
	}


	public function actionDefault()
	{
		$this->template->switchHeader = true;
		$this->template->posts = $this->getPosts(0, 5);
		$this->template->postCount = count($this->template->posts);
	}


	public function actionNewPost()
	{
		$this->template->switchHeader = true;
	}


	protected function createComponentNewPostForm()
	{
		return $this->newPostFactory->create(function () {
				$this->redirect('Forum:');
			});
	}


	public function actionViewPost(): void
	{
		$this->template->switchHeader = true;
	}

	private function getPosts(int $pageStart, int $pageStop): array
	{
		$posts = $this->postsModel->findBy(['id >=' => $pageStart, 'id <' => $pageStop])->fetchAll();
		return $posts;
	}

}
