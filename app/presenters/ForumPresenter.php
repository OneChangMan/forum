<?php

namespace App\Presenters;

use App\Forms;
use Nette\Application\UI\Form;
use App\Model\PostsModel;

class ForumPresenter extends ForumSecuredPresenter
{

	/** @var Forms\NewPostFormFactory */
	private $newPostFactory;

	/** @var postsModel @inject */
	public $postsModel;


	public function __construct(Forms\NewPostFormFactory $newPostFactory, PostsModel $postsModel)
	{
		$this->postsModel = $postsModel;
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


	/**
	 * Sign-in form factory.
	 * @return Form
	 */
	protected function createComponentNewPostForm()
	{
		return $this->newPostFactory->create(function () {
				$this->restoreRequest($this->backlink);
			});
	}


	public function actionViewPost()
	{
		$this->template->switchHeader = $this->switchHeader;
	}

}
