<?php

interface EventStorageInterface
{
	/**
	 * Stores an event
	 * @param  EventInterface $event
	 * @return bool
	 */
    public function store(EventInterface $event) : bool;

}
