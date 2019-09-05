<?php
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use SSDMTechTest\Events\SportsListener;

//include_once('src/Events/FootBallListener.php');

class FootBallListenerTest extends TestCase
{
	/**
	 * Test for valid football events 
	 * @return void
	 */
    public function testChooseValidFootballEvents()
    {
    	global $content;
    	$content = array();

    	global $contenttypes;
    	$contenttypes = array();
 
		$mockEvent1 = (new class extends Event { 					//Anonmous Mock object
			public function getSports(){
				return 'football';
			}
		    public function getEventType() {
		    	return 'kickoff';
		    }
		}); 

		$mockEvent2 = (new class extends Event { 					//Anonmous Mock object
			public function getSports(){
				return 'football';
			}
		    public function getEventType() {
		    	return 'corner';
		    }
		}); 

		$mockEvent3 = (new class extends Event { 					//Anonmous Mock object
			public function getSports(){
				return 'football';
			}
		    public function getEventType() {
		    	return 'goal';
		    }
		}); 

	    $this->assertSame('football', $mockEvent1->getSports());	
		$this->assertSame('kickoff', $mockEvent1->getEventType());

	    $this->assertSame('football', $mockEvent2->getSports());	
		$this->assertSame('corner', $mockEvent2->getEventType());

	    $this->assertSame('football', $mockEvent3->getSports());	
		$this->assertSame('goal', $mockEvent3->getEventType());

		$dispatcher = new EventDispatcher();
		$listener = new SportsListener(new class { //Anonmous Mock object
			public $content = array();
		    public function store($event) {
		    	global $content;
		    	global $contenttypes;
		        $content []= $event->getEventType();
		        $contenttypes [$event->getSports()]= $event->getSports();
		    }
		});
		$dispatcher->addListener('sports.action', [$listener, 'onSportsAction']);
		$dispatcher->dispatch($mockEvent1, 'sports.action');
		$dispatcher->dispatch($mockEvent2, 'sports.action');
		$dispatcher->dispatch($mockEvent3, 'sports.action');

		$this->assertArrayHasKey('football', $contenttypes);
		$this->assertContains('kickoff', $content);
		$this->assertContains('corner', $content);
		$this->assertContains('goal', $content);
    }

	/**
	 * Test for invalid football events 
	 * @return void
	 */
    public function testChooseNonFootballEvents()
    {
    	global $content;
    	$content = array();

    	global $contenttypes;
    	$contenttypes = array();
 
		$mockEvent1 = (new class  extends Event{ 					//Anonmous Mock object
			public function getSports(){
				return 'football';
			}
		    public function getEventType() {
		    	return 'serve';
		    }
		}); 

		$mockEvent2 = (new class extends Event { 					//Anonmous Mock object
			public function getSports(){
				return 'tennis';
			}
		    public function getEventType() {
		    	return 'serve';
		    }
		}); 

		$mockEvent3 = (new class  extends Event{ 					//Anonmous Mock object
			public function getSports(){
				return 'badminton';
			}
		    public function getEventType() {
		    	return 'smash';
		    }
		}); 

	    $this->assertSame('football', $mockEvent1->getSports());	
		$this->assertSame('serve', $mockEvent1->getEventType());

	    $this->assertSame('tennis', $mockEvent2->getSports());	
		$this->assertSame('serve', $mockEvent2->getEventType());

	    $this->assertSame('badminton', $mockEvent3->getSports());	
		$this->assertSame('smash', $mockEvent3->getEventType());

		$dispatcher = new EventDispatcher();
		$listener = new SportsListener(new class { //Anonmous Mock object
			public $content = array();
		    public function store($event) {
		    	global $content;
		    	global $contenttypes;
		        $content []= $event->getEventType();
		        $contenttypes [$event->getSports()]= $event->getSports();
		    }
		});
		$dispatcher->addListener('sports.action', [$listener, 'onSportsAction']);
		$dispatcher->dispatch($mockEvent1, 'sports.action');
		$dispatcher->dispatch($mockEvent2, 'sports.action');
		$dispatcher->dispatch($mockEvent3, 'sports.action');

		$this->assertEmpty($contenttypes);
		$this->assertEmpty($content);
    }
}
