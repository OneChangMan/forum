<?php

namespace App\Presenters;

use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/** @var boolean */
	public $switchHeader;


	public function actionDefault()
	{
		$this->switchHeader = false;
	}

}
