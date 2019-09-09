<?php

namespace App\Presenters;

class ForumSecuredPresenter extends BasePresenter
{

	protected function startup()
	{
		parent::startup();
		if (!$this->user->loggedIn) {
			$this->flashMessage('Please, log in to view our forum.');
			$this->redirect('Homepage:');
		}
	}

}
