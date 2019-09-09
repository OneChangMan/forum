<?php

namespace App\Presenters;

class ForumPresenter extends ForumSecuredPresenter
{
	public function actionDefault(){
		$this->template->switchHeader = true;
	}
}
