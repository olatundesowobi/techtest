Technical Test
=============================

Implemented a Listener Class based on the symfony/eventdispatcher. 

Implemented PHP Unit Tests to identify valid events and to ignore invalid events. 
In order to test the class used anonymous mock objects were used to represent the 
events and the store.


### Review 
    
It would probably be worthwhile to review the EventInterface which uses the 
EventInterface interface and not an actual class to define the event object
in the store function.  
 
EventStorageInterface:

```php
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
```

In order to ensure code is testable and usable the store the listener use object class.


```php
<?php
use Symfony\Contracts\EventDispatcher\Event;

namespace SSDMTechTest\Events;

class SportsListener
{
  /**
   * Construction of Footballlistener
   * @param  Object $event
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

        

    if ((in_array($event->getSports(), $valid_sports)) i
      && (in_array($event->getEventType(), $validfootballevents))){
      $this->eventStore->store($event);
    } else {
      
    }
  }
}

```

### Setup


#### Prerequisites

* PHP 7.1+

#### Setup with composer

- `cd` into the project's root directory
- run `php composer.phar update` to install the dependencies needed.
- run `vendor/bin/phpunit ` to run the test suite.



