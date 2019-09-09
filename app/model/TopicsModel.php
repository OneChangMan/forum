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


	public function getTopics(): \Nette\Database\Table\Selection
	{
		$posts = $this->findAll();
		return $posts;
	}


	public function getActiveTopics(): ?array
	{
		$activeTopics = $this->findBy(['deactivated IS NULL']);

		if ($activeTopics->count() > 0) {
			$activeTopicsArray = [];

			foreach($activeTopics as $topic){
				$activeTopicsArray[$topic->id] = $topic->topic;
			}
			
			return $activeTopicsArray;
		}
		return NULL;
	}

}
