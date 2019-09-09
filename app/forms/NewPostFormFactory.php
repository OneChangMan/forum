<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use App\Model\PostsModel;

class NewPostFormFactory
{

	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;

	/** @var PostsModel @inject */
	public $postsModel;


	public function __construct(FormFactory $factory, User $user, PostsModel $postsModel)
	{
		$this->postsModel = $postsModel;
		$this->factory = $factory;
		$this->user = $user;
	}

	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{
		$form = $this->factory->create();
		$form->addText('title', 'Title')
			->setRequired('Please enter the title of your post.');

		$form->addTextArea('content', 'Content')
			->setRequired("Posts can't be empty!");

		$form->addSubmit('send', 'Post');

		$form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
			$values['uid'] = $this->user->id;
			$this->postsModel->add($values);
			$onSuccess();
		};

		return $form;
	}

}
