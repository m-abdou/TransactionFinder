<?php

namespace App\Services\Handlers;

use JMS\Serializer\SerializerBuilder;
use Symfony\Component\Form\Form;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Operator
{

    /**
     * @var ArrayCollection
     */
    private $transactions;

    /** @var Criteria $criteria */
    private $criteria;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function setTransactions($collections) {
        $this->transactions = $collections;
    }

    public function getTransactions() {
        return $this->transactions;
    }

    /**
     * provide search by query string
     * @param $queryParam
     * @return array
     */
    public function searchByQuery($queryParam){
        $this->criteria = Criteria::create();


        if(isset($queryParam['statusCode']) && !empty($queryParam['statusCode'])) {
            $this->searchByStatusCode($queryParam['statusCode']);
        }

        if(isset($queryParam['provider']) && !empty($queryParam['provider'])) {
            $this->searchByProvider($queryParam['provider']);
        }

        if(isset($queryParam['currency']) && !empty($queryParam['currency'])) {
            $this->searchByCurrency($queryParam['currency']);
        }

        if((isset($queryParam['amountMin']) && !empty($queryParam['amountMax']))
           && (isset($queryParam['amountMin']) && !empty($queryParam['amountMax']))
        ) {
            $this->searchByAmount($queryParam['amountMin'], $queryParam['amountMax']);
        }


        $result = $this->convertCollectionToArray($this->getTransactions()->matching($this->criteria));

        return ['status' => true , 'transactions' => $result];
    }


    /**
     * searchByStatusCode
     *
     * @param string $statusCode statusCode
     *
     * @return void
     *
     */
    public function searchByStatusCode(string $statusCode) :void
    {
        $condition = Criteria::expr()->eq('statusCode', $statusCode);
        $this->criteria->andWhere($condition);
    }

    /**
     * searchByProvider
     *
     * @param string $provider provider
     *
     * @return void
     *
     */
    public function searchByProvider(string $provider) : void
    {
        $condition = Criteria::expr()->eq('provider', $provider);
        $this->criteria->andWhere($condition);
    }

    /**
     * searchByCurrency
     *
     * @param string $currency currency
     *
     * @return void
     *
     */
    public function searchByCurrency(string $currency) : void
    {
        $condition = Criteria::expr()->eq('currency', $currency);
        $this->criteria->andWhere($condition);
    }

    /**
     * searchByAmount
     *
     * @param float $min min
     * @param float $max max
     *
     * @return void
     *
     */
    public function searchByAmount(float $min, float $max) : void
    {
        $amountFromCondition = Criteria::expr()->gte('amount', $min);
        $amountToCondition = Criteria::expr()->lte('amount', $max);
        $this->criteria->andWhere($amountFromCondition)->andWhere($amountToCondition);
    }

    /**
     * convert array of objects to array
     * @param ArrayCollection $collection
     * @return array
     */
    public function convertCollectionToArray(ArrayCollection $collection):array
    {
        return array_values(json_decode($this->serializer->serialize($collection, 'json'), true));
    }

}
