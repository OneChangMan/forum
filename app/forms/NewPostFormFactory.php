<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class NewPostFormFactory
{

	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;


	public function __construct(FormFactory $factory, User $user)
	{
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
			
			$onSuccess();
		};

		return $form;
	}

}
