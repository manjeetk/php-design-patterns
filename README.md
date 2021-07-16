# Design Patterns in PHP
The Decorator Pattern, Adapter Pattern, Template Method Pattern, Strategy Pattern, Observer Pattern

## Decorator Deisgn Pattern

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