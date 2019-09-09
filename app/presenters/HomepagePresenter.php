<?php

namespace App\Presenters;

use App\Forms;
use Nette\Application\UI\Form;

final class HomepagePresenter extends BasePresenter
{

	/** @persistent */
	public $backlink = '';

	/** @var Forms\SignInFormFactory */
	private $signInFactory;

	/** @var Forms\SignUpFormFactory */
	private $signUpFactory;


	public function __construct(Forms\SignInFormFactory $signInFactory, Forms\SignUpFormFactory $signUpFactory)
	{
		$this->signInFactory = $signInFactory;
		$this->signUpFactory = $signUpFactory;
	}


	public function actionDefault()
	{
		$this->loggedCheck();
	}


	public function actionRegistration()
	{
		$this->loggedCheck();
	}


	/**
	 * Sign-in form factory.
	 * @return Form
	 */
	protected function createComponentSignInForm()
	{
		return $this->signInFactory->create(function () {
				$this->restoreRequest($this->backlink);
				$this->redirect('Forum:');
			});
	}


	/**
	 * Sign-up form factory.
	 * @return Form
	 */
	protected function createComponentSignUpForm()
	{
		return $this->signUpFactory->create(function () {
				$this->redirect('Homepage:');
			});
	}


	public function actionOut()
	{
		$this->getUser()->logout();
	}


	private function loggedCheck()
	{
		if ($this->user->isLoggedIn()) {
			$this->redirect(':Forum:');
		}
	}

}
