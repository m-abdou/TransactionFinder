<?php

namespace App\Services\Provider;



use App\Services\Provider\Mapper\FlypayBMapper;
use Doctrine\Common\Collections\ArrayCollection;
use App\Services\Provider\Model\FlypayB as model;

class FlypayB extends AbstractProvider
{

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $transactions;

    /** @var  FlypayBMapper*/
    private $mapper;

    public function __construct(FlypayBMapper $mapper)
    {
        $this->mapper = $mapper;
        $this->transactions = $this->mapper->convertJsonToArrayCollection($this->fetch());
    }


    /**
     * initialize url data collector
     * @return string
     */
    protected function getAPIURL():string
    {
        return "https://api.myjson.com/bins/bq32l";
    }

    /**
     * setTransaction
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $transactions transactions
     *
     * @return void
     *
     */
    public function setTransaction(ArrayCollection $transactions)
    {

        if(!$this->transactions || empty($transactions)) {
            $this->transactions = $this->mapper->convertJsonToArrayCollection($this->fetch());
        }else {
            $this->transactions = $transactions;
        }
    }

    /**
     * getTransaction
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     *
     */
    public function getTransaction()
    {
        return $this->transactions;
    }

}
