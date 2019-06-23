<?php

namespace App\Services\Handlers;

use App\Services\Provider\ProviderFactory;
use Doctrine\Common\Collections\ArrayCollection;

class Loader
{

    public function __construct(ProviderFactory $factory)
    {
        $this->providerFactory = $factory;
        $this->data = [];
    }


    public function load() {
        $this->data = new ArrayCollection();
        foreach ($this->getProviders() as $providerName) {
            $provider = $this->providerFactory->createProvider($providerName);
            $this->data = new ArrayCollection(
                array_merge($this->data->toArray(), $provider->getTransaction()->toArray())
            );
        }

        return $this->data;
    }

    public function getProviders() {
        return ["flypayA", "flypayB"];
    }
}
