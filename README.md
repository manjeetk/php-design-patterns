# Design Patterns in PHP
The Decorator Pattern, Adapter Pattern, Template Method Pattern, Strategy Pattern, Observer Pattern

## Decorator Design Pattern

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
print_r("Basic Website Design Price: ". $basicPrice . "\n");

$customPrice = (new customDesign(new BasicDesign()))->getCost();
print_r("Custom and Basic Website Design Price: ". $customPrice . "\n");

$seoPrice = (new SEO(new BasicDesign()))->getCost();
print_r("SEO and Basic Website Design Price: ". $seoPrice . "\n");

$wholePackagePrice = (new SEO(new CustomDesign(new BasicDesign())))->getCost();
print_r("Price for all services: ". $wholePackagePrice);


```
## Adapter Design Pattern

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

```