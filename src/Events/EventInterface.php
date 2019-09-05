<?php

interface EventInterface
{

    /**
     * Should return the sport type e.g. 'football'
     * @return string
     */
    public function getSport() : string;

    /**
     * Should return the event type e.g. 'kickoff'
     * @return string
     */
    public function getEventType() : string;

}
