<?php 

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

?>
