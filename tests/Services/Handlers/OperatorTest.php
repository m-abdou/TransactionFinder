<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\Collections\ArrayCollection;
use App\Services\Provider\Model\FlypayB;
use App\Services\Provider\Model\FlypayA;

class OperatorTest extends WebTestCase
{

    public function setUp()
    {
        static::bootKernel();
        $kernel = static::$kernel;
        $this->operator = $kernel->getContainer()->get('service.handler.operator');
    }

    public function testSearchByProvider()
    {
        $this->mockObjects();
        $transactions = $this->operator->searchByQuery(['provider' => 'flypayA']);
        $this->assertEquals($transactions['transactions'][0]['provider'], 'flypayA');
    }

    public function testSearchAmount()
    {
        $this->mockObjects();
        $transactions = $this->operator->searchByQuery(['amountMin' => 10, 'amountMax' => 40]);
        $this->assertEquals($transactions['transactions'][0]['amount'], 20);
    }


    private function mockObjects()
    {
        $transactions = new ArrayCollection();
        $transaction = new FlypayA();
        $transaction->setCurrency('EGP');
        $transaction->setAmount(20);
        $transaction->setOrderId('test');
        $transaction->setProvider('flypayA');
        $transaction->setTransactionId('testtest');
        $transaction->setStatusCode(1);

        $transactions->add($transaction);


        $transaction = new FlypayB();
        $transaction->setCurrency('EGP');
        $transaction->setAmount(30);
        $transaction->setOrderId('test');
        $transaction->setProvider('flypayB');
        $transaction->setTransactionId('test');
        $transaction->setStatusCode(100);

        $transactions->add($transaction);

        $this->operator->setTransactions($transactions);
    }
}
