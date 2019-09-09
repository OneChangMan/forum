<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use App\Model\PostsModel;
use App\Model\TopicsModel;

class NewPostFormFactory
{

	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;

	/** @var PostsModel @inject */
	public $postsModel;

	/** @var TopicsModel @inject */
	public $topicsModel;


	public function __construct(FormFactory $factory, User $user, PostsModel $postsModel, TopicsModel $topicsModel)
	{
		$this->topicsModel = $topicsModel;
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
			->setHtmlAttribute('style="width: 100%;"')
			->setRequired('Please enter the title of your post.');

		$form->addTextArea('content', 'Content')
			->setHtmlAttribute('rows="4" cols="50" class="my-2"')
			->setRequired("Posts can't be empty!");

		$form->addSelect('topicId', 'Your topic', $this->getTopics())
			->setHtmlAttribute('style="width: 100%;"')
			->setRequired("No topic, no post!");

		$form->addSubmit('send', 'Post')
			->setHtmlAttribute('class="custom-submit-btn"');

		$form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
			$values['uid'] = $this->user->id;
			$this->postsModel->add($values);
			$onSuccess();
		};

		return $form;
	}

	private function getTopics(){
		return $this->topicsModel->getActiveTopics();
	}

}
