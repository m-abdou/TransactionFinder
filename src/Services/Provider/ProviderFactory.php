<?php

namespace App\Services\Provider;


use App\Services\Provider\Mapper\FlypayAMapper;
use App\Services\Provider\Mapper\FlypayBMapper;

class ProviderFactory
{

    public function __construct(FlypayAMapper $flypayAMapper, FlypayBMapper $flypayBMapper)
    {
        $this->flypayAMapper = $flypayAMapper;
        $this->flypayBMapper = $flypayBMapper;
    }

    /**
     * createProvider
     *
     * @param $provider string
     *
     * @return \App\Services\Provider\FlypayA|\App\Services\Provider\FlypayB
     *
     */
    function createProvider($provider) {
        switch ($provider) {
            case 'flypayA' :
                return new FlypayA($this->flypayAMapper);
                break;
            case 'flypayB' :
                return  new FlypayB($this->flypayBMapper);
                break;
        }
    }

}
