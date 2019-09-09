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
		$this->template->switchHeader = $this->switchHeader = true;
	}


	public function actionNewPost()
	{
		$this->template->switchHeader = $this->switchHeader;
	}

	
	protected function createComponentNewPostForm()
	{
		return $this->newPostFactory->create(function () {
				$this->redirect('Forum:');
			});
	}


	public function actionViewPost()
	{
		$this->template->switchHeader = $this->switchHeader;
	}

}
