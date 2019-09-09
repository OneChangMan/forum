<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

/**
 * Description of TopicsModel
 *
 * @author kuroi
 */
class TopicsModel extends Model
{
	public function getTopics()
	{
		$posts = $this->findAll();
		return $posts;
	}
}
