<?php

use Symfony\Contracts\EventDispatcher\Event;

namespace SSDMTechTest\Events;

class SportsListener
{
	/**
	 * Construction of SportsListener
	 * @param  Object $event
	 * @return void
	 */
	public function __construct(Object $store)
    {
        $this->eventStore = $store;
    }

	/**
	 * A handler for sports Events
	 * @param  Object $event that extends from a class 
	 * @return void
	 */
    public function onSportsAction(Object $event)
    {
      	$valid_sports = array(
        	'football'
        );
        
        $validfootballevents = array(
        	'kickoff',
        	'goal',
        	'yellowcard',
			'redcard',
			'penalty',
			'halftime',
			'fulltime',
			'extratime',
			'freekick',
			'corner'
		);

        

        if ((in_array($event->getSports(), $valid_sports)) && (in_array($event->getEventType(), $validfootballevents))){
        	$this->eventStore->store($event);
        } else {
        	return;
        }
    }
}
