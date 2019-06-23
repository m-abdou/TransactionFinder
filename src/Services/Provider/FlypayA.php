<?php

namespace App\Services\Provider;


use App\Services\Provider\Mapper\FlypayAMapper;
use Doctrine\Common\Collections\ArrayCollection;
use App\Services\Provider\Model\FlypayA as model;



class FlypayA extends AbstractProvider
{

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $transactions;

    /** @var  FlypayAMapper*/
    private $mapper;

    public function __construct(FlypayAMapper $mapper)
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
        return "https://api.myjson.com/bins/11wxz1";
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
     * return Transaction
     * @return ArrayCollection
     */
    public function getTransaction()
    {
        return $this->transactions;
    }
}
