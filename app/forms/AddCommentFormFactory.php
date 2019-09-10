<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use App\Model\PostsModel;
use App\Model\CommentsModel;

class AddCommentFormFactory
{

	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;

	/** @var PostsModel @inject */
	public $postsModel;

	/** @var CommentsModel @inject */
	public $commentsModel;

	/** @var integer*/
	private $postId;


	public function __construct(FormFactory $factory, User $user, PostsModel $postsModel, CommentsModel $commentsModel)
	{
		$this->commentsModel = $commentsModel;
		$this->factory = $factory;
		$this->postsModel = $postsModel;
		$this->user = $user;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{
		$form = $this->factory->create();

		$form->addTextArea('comment', '')
			->setHtmlAttribute('rows="4" cols="50" class="my-2"')
			->setRequired("Posts can't be empty!");

		$form->addSubmit('send', 'Comment')
			->setHtmlAttribute('class="custom-submit-btn"');

		$form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
			$values['userId'] = $this->user->id;
			$values['pid'] = $this->postId;

			$this->commentsModel->add($values);
			$onSuccess();
		};

		return $form;
	}


	private function getTopics()
	{
		return $this->topicsModel->getActiveTopics();
	}

	public function setPostId(int $postId): AddCommentFormFactory
		{
		$this->postId = $postId;
		return $this;
	}

}
