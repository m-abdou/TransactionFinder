<?php

namespace App\Services\Provider;

use GuzzleHttp\Client as Client;

abstract class AbstractProvider
{

    protected abstract function getApiUrl():string;

    /**
     * responsible for fetch data from external api
     * @return object
     */
    public function fetch()
    {
        $client = new Client();
        $url = $this->getApiUrl();
        $response = $client->get($url);
        return $response->getBody()->getContents();
    }

}
