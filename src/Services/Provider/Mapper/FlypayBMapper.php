<?php

namespace App\Services\Provider\Mapper;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\SerializerBuilder;

class FlypayBMapper implements MapperInterface
{

    private $serializer;

    /**
     * @var ArrayCollection
     * @Serializer\SerializedName("transactions")
     * @Serializer\Type(name="ArrayCollection<App\Services\Provider\Model\FlypayB>")
     */
    private $transactions;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * convertJsonToArrayCollection
     * convert json object to array of collection type hotel
     *
     * @param $jsonResponse json
     * @param $model
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     *
     */
    public function convertJsonToArrayCollection($jsonResponse) :ArrayCollection
    {
        return $this->serializer->deserialize($jsonResponse, FlypayBMapper::class, 'json')->transactions;
    }
}
