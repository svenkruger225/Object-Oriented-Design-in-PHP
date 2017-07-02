<?php

class PurchaseManager
{
    protected $purchases;
    protected $logger;

    public function __construct()
    {
        $this->logger = IoC::make('Logger');
    }

    public function purchaseDiscountedProduct($product, $discountPercentage)
    {
        $origPrice = $product->getPrice();
        $newPrice = $origPrice - (($discountPercentage / 100) * $origPrice);

        $discountedProduct = IoC::make('Product', [ $product->getName(), $newPrice ]);
        $this->logger->log("Applying discount to ".$product->getName());
        $this->purchase($discountedProduct);
    }

    public function purchase($product)
    {
        $this->purchases[] = $product;
        $log = "Purchased ".$product->getName()." for $".$product->getPrice();
        $this->logger->log($log);
    }

    public function purchaseHistory()
    {
        return $this->purchases;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
