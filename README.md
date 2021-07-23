# Design Patterns in PHP
The Decorator Pattern, Adapter Pattern, Template Method Pattern, Strategy Pattern, Observer Pattern

## Decorator design pattern

In object-oriented programming, the decorator pattern is a design pattern that allows behavior to be added to an individual object, dynamically, without affecting the behavior of other objects from the same class. The decorator pattern is often useful for adhering to the Single Responsibility Principle, as it allows functionality to be divided between classes with unique areas of concern. Decorator use can be more efficient than subclassing, because an object's behavior can be augmented without defining an entirely new object.

## What problems can it solve?

- Responsibilities should be added to (and removed from) an object dynamically at run-time.
- A flexible alternative to subclassing for extending functionality should be provided.

When using subclassing, different subclasses extend a class in different ways. But an extension is bound to the class at compile-time and can't be changed at run-time.

## What solution does it describe?

Define Decorator objects that

- implement the interface of the extended (decorated) object (Component) transparently by forwarding all requests to it
- perform additional functionality before/after forwarding a request.

This allows working with different Decorator objects to extend the functionality of an object dynamically at run-time.
See also the UML class and sequence diagram below.

```php 

interface WebsiteDesign {
    public function getCost();
}

class BasicDesign implements WebsiteDesign {
    public function getCost() {
        return 1000;
    }
}

class CustomDesign implements WebsiteDesign {

    protected $websiteDesign;

    function __construct(WebsiteDesign $websiteDesign) {
        $this->websiteDesign = $websiteDesign;
    }

    public function getCost() {
        return 500 + $this->websiteDesign->getCost();
    }
}

class SEO implements WebsiteDesign {

    protected $websiteDesign;

    function __construct(WebsiteDesign $websiteDesign) {
        $this->websiteDesign = $websiteDesign;
    }

    public function getCost() {
        return 700 + $this->websiteDesign->getCost();
    }
}

$basicPrice = (new BasicDesign())->getCost();
var_dump("Basic Website Design Price: ". $basicPrice . "\n");

$customPrice = (new customDesign(new BasicDesign()))->getCost();
var_dump("Custom and Basic Website Design Price: ". $customPrice . "\n");

$seoPrice = (new SEO(new BasicDesign()))->getCost();
var_dump("SEO and Basic Website Design Price: ". $seoPrice . "\n");

$wholePackagePrice = (new SEO(new CustomDesign(new BasicDesign())))->getCost();
var_dump("Price for all services: ". $wholePackagePrice);

```
## Adapter design pattern

The adapter pattern is a software design pattern (also known as wrapper, an alternative naming shared with the decorator pattern) that allows the interface of an existing class to be used as another interface. It is often used to make existing classes work with others without modifying their source code.

An example is an adapter that converts the interface of a Document Object Model of an XML document into a tree structure that can be displayed.

*An adapter allows two incompatible interfaces to work together. This is the real-world definition for an adapter. Interfaces may be incompatible, but the inner functionality should suit the need. The adapter design pattern allows otherwise incompatible classes to work together by converting the interface of one class into an interface expected by the clients.*

*The adapter design pattern solves problems like:*

- How can a class be reused that does not have an interface that a client requires?
- How can classes that have incompatible interfaces work together?
- How can an alternative interface be provided for a class?
- Often an (already existing) class can't be reused only because its interface doesn't conform to the interface clients require.

*The adapter design pattern describes how to solve such problems:*

- Define a separate adapter class that converts the (incompatible) interface of a class (adaptee) into another interface (target) clients require.
- Work through an adapter to work with (reuse) classes that do not have the required interface.
- The key idea in this pattern is to work through a separate adapter that adapts the interface of an (already existing) class without changing it.

Clients don't know whether they work with a target class directly or through an adapter with a class that does not have the target interface.

```php

interface BookInterface {
    public function open();
    public function turnPage();
} 

class Book implements BookInterface {

    public function open() {
        var_dump("Open the paper book page.");
    }
}

interface eReaderInterface {
    public function turnOn();
    public function pressNextButton();
}

class Kindle implements eReaderInterface {

    public function turnOn() {
        var_dump("Turn on the kindle");
    }

    public function pressButton() {
        var_dump("press the next button");
    }

    public function turnPage() {
        var_dump("Turn on the paper book page.");
    }
}

class KindleAdapter implements BookInterface {

    private $kindle;

    public function __construct(Kindle $kindle) {
        $this->kindle = $kindle;
    }

    public function open() {
        return $this->kindle->turnOn();
    }

    public function turnPage() {
        return $this->kindle->pressNextButton();
    }
}

//A person can a read book or kindle
class Person {

    public function read(BookInterface $book) {
        $book->read();
        $book->turnPage();
    } 
}

(new Person)->read(new Book());
(new Person)->read(new kindleAdapter(new Kindle));

```

## Template method pattern

The template method is a method in a superclass, usually an abstract superclass, and defines the skeleton of an operation in terms of a number of high-level steps. These steps are themselves implemented by additional helper methods in the same class as the template method.

The helper methods may be either abstract methods, in which case subclasses are required to provide concrete implementations, or hook methods, which have empty bodies in the superclass. Subclasses can (but are not required to) customize the operation by overriding the hook methods. The intent of the template method is to define the overall structure of the operation, while allowing subclasses to refine, or redefine, certain steps.

*This pattern has two main parts:*

The "template method" is implemented as a method in a base class (usually an abstract class). This method contains code for the parts of the overall algorithm that are invariant. The template ensures that the overarching algorithm is always followed. In the template method, portions of the algorithm that may vary are implemented by sending self messages that request the execution of additional helper methods. In the base class, these helper methods are given a default implementation, or none at all (that is, they may be abstract methods).

Subclasses of the base class "fill in" the empty or "variant" parts of the "template" with specific algorithms that vary from one subclass to another. It is important that subclasses do not override the template method itself.

*The template method is used for the following reasons.*

- It lets subclasses implement varying behavior (through overriding of the hook methods).
It avoids duplication in the code: the general workflow of the algorithm is implemented once in the abstract class's template method, and necessary variations are implemented in the subclasses.
- It controls the point(s) at which specialization is permitted. If the subclasses were to simply override the template method, they could make radical and arbitrary changes to the workflow. In contrast, by overriding only the hook methods, only certain specific details of the workflow can be changed, and the overall workflow is left intact.

```php
abstract class Game
{
    abstract protected function initialize();
    abstract protected function startPlay();
    abstract protected function endPlay();

    public final function play()
    {
        $this->initialize();
        $this->startPlay();
        $this->endPlay();
    }
}

class Mario extends Game
{
    protected function initialize()
    {
        var_dump("Mario Game Initialized! Start playing.");
    }

    protected function startPlay()
    {
        var_dump("Mario Game Started. Enjoy the game!");
    }

    protected function endPlay()
    {
        var_dump("Mario Game Finished!");
    }

}

class Tankfight extends Game
{
    protected function initialize()
    {
        var_dump("Tankfight Game Initialized! Start playing.");
    }

    protected function startPlay()
    {
        var_dump("Tankfight Game Started. Enjoy the game!");
    }

    protected function endPlay()
    {
        var_dump("Tankfight Game Finished!");
    }

}

$game = new Tankfight();
$game->play();

$game = new Mario();
$game->play();

```

## Strategy pattern

The strategy pattern (also known as the policy pattern) is a behavioral software design pattern that enables selecting an algorithm at runtime. Instead of implementing a single algorithm directly, code receives run-time instructions as to which in a family of algorithms to use.

Strategy lets the algorithm vary independently from clients that use it. Strategy is one of the patterns included in the influential book Design Patterns by Gamma et al. that popularized the concept of using design patterns to describe how to design flexible and reusable object-oriented software. Deferring the decision about which algorithm to use until runtime allows the calling code to be more flexible and reusable.

For instance, a class that performs validation on incoming data may use the strategy pattern to select a validation algorithm depending on the type of data, the source of the data, user choice, or other discriminating factors. These factors are not known until run-time and may require radically different validation to be performed. The validation algorithms (strategies), encapsulated separately from the validating object, may be used by other validating objects in different areas of the system (or even different systems) without code duplication.

Typically, the strategy pattern stores a reference to some code in a data structure and retrieves it. This can be achieved by mechanisms such as the native function pointer, the first-class function, classes or class instances in object-oriented programming languages, or accessing the language implementation's internal storage of code via reflection.

```php

interface Logger {
    public function log($data);
}

class LogToFile implements Logger {

    public function log($data) {
        var_dump("Log the data to the File");
    }
}

class LogToDatabase implements Logger {    
   public function log($data) {
        var_dump("Log the data to the DB");
    }    
}

class LogToWebService implements Logger {
    public function log($data) {
        var_dump("Log the data to the Web Service");
    }
}

class App {
    public function log($data, Logger $logger) {    
        $logger = $logger ?: new LogToFile;
        $logger->log($data);
    }
}

$app = new App();
$app->log("Log", new LogToFile);
$app->log("Log", new LogToDatabase);
$app->log("Log", new LogToWebService);

```

## Chain-of-responsibility pattern

The chain-of-responsibility pattern is a behavioral design pattern consisting of a source of command objects and a series of processing objects. Each processing object contains logic that defines the types of command objects that it can handle; the rest are passed to the next processing object in the chain. A mechanism also exists for adding new processing objects to the end of this chain.

In a variation of the standard chain-of-responsibility model, some handlers may act as dispatchers, capable of sending commands out in a variety of directions, forming a tree of responsibility. In some cases, this can occur recursively, with processing objects calling higher-up processing objects with commands that attempt to solve some smaller part of the problem; in this case recursion continues until the command is processed, or the entire tree has been explored. An XML interpreter might work in this manner.

This pattern promotes the idea of loose coupling.

*What problems can the Chain of Responsibility design pattern solve?*

- Coupling the sender of a request to its receiver should be avoided.
- It should be possible that more than one receiver can handle a request.

Implementing a request directly within the class that sends the request is inflexible because it couples the class to a particular receiver and makes it impossible to support multiple receivers

*What solution does the Chain of Responsibility design pattern describe?*

- Define a chain of receiver objects having the responsibility, depending on run-time conditions, to either handle a request or forward it to the next receiver on the chain (if any).

This enables us to send a request to a chain of receivers without having to know which one handles the request. The request gets passed along the chain until a receiver handles the request. The sender of a request is no longer coupled to a particular receiver.

```php

abstract class HomeChecker {
    protected $successor;
    public abstract function check(HomeStatus $home);

    public function succeedWith(HomeChecker $successor) {
        $this->successor = $successor;
    }

    public function next(HomeStatus $home) {
        if(!this->successor) {
            $this->successor = check($home);
        }
    }
}

class Locks extends HomeChecker {
    public function check(HomeStatus $home){
        if(!home->locked) {
            throw new Exception("The doors are not locked!");
        }
        $this->next($home);
    }
}

class Lights extends HomeChecker {
    public function check(HomeStatus $home){
        if(!home->lightsOff) {
            throw new Exception("The lights are on!");
        }
        $this->next($home);
    }
}

class Alarm extends HomeChecker {
    public function check(HomeStatus $home){
        if(!home->alarmOn) {
            throw new Exception("The alarm is not on!");
        }
        $this->next($home);
    }
}

class HomeStatus {
    public $alarmOn = false;
    public $locked = true;
    public $lightsOff = false;
}

$locks = new Locks;
$lights = new Lights;
$alarm = new Alarm;

$locks->succeedWith($lights);
$lights->succeedWith($alarm);

$locks->check(new HomeStatus);

```