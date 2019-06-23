<?php

namespace App\Services\Provider\Mapper;


use Doctrine\Common\Collections\ArrayCollection;

interface MapperInterface
{
    public function convertJsonToArrayCollection($jsonResponse) : ArrayCollection;
}
