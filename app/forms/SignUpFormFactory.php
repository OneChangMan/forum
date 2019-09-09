<?php

namespace App\Forms;

use App\Model;
use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\DateTime;


final class SignUpFormFactory
{
	use Nette\SmartObject;

	const PASSWORD_MIN_LENGTH = 7;

	/** @var FormFactory */
	private $factory;

	/** @var Model\UserManager */
	private $userManager;


	public function __construct(FormFactory $factory, Model\UserManager $userManager)
	{
		$this->factory = $factory;
		$this->userManager = $userManager;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{
		$form = $this->factory->create();
		$form->addText('username', 'Pick a username:')
			->setHtmlAttribute('class="ml-1"')
			->setRequired('Please pick a username.');

		$form->addEmail('email', 'Your e-mail:')
			->setHtmlAttribute('class="ml-1"')
			->setRequired('Please enter your e-mail.');

		$form->addPassword('password', 'Create a password:')
			->setHtmlAttribute('class="ml-1"')
			->setHtmlAttribute('placeholder', 'Minimum 7 characters')
			->setRequired('Please create a password.')
			->addRule($form::MIN_LENGTH, null, self::PASSWORD_MIN_LENGTH);

		$form->addSubmit('send', 'Sign up')
			->setHtmlAttribute('class="ml-1"');

		$form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
			try {
				$this->userManager->add($values->username, $values->email, $values->password, 2, (new DateTime)->format('Y-m-d h:i:s'));
			} catch (Model\DuplicateNameException $e) {
				$form['username']->addError('Username is already taken.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}
