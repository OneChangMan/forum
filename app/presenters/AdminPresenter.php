<?php

namespace App\Presenters;

class AdminPresenter extends ForumSecuredPresenter
{




	public function actionDefault()
	{
		$this->isAdmin();
	}


	public function actionAddTopic()
	{
		$this->isAdmin();
	}


	/**
	 * Sign-in form factory.
	 * @return Form
	 */
	protected function createComponentNewTopicForm()
	{
		return $this->newTopicFormFactory->create(function () {
				$this->redirect('Admin:');
			});
	}


	public function banUser()
	{
		$this->isAdmin();
	}


	private function isAdmin(): void
	{
		foreach ($this->user->roles as $role) {
			if ($role === 1) {
				return;
			}
		}
		$this->user->logout();
		$this->flashMessage('Please, log in to view our forum.');
		$this->redirect('Homepage:');
	}

}
