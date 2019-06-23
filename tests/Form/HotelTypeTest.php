<?php

use App\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HotelTypeTest extends KernelTestCase
{
    /** @var \Symfony\Component\Form\FormFactory $formFactory */
    private $formFactory;

    public function setUp()
    {
        static::bootKernel();
        $kernel = static::$kernel;
        $this->formFactory = $kernel->getContainer()->get('form.factory');
    }


    public function testSubmitWithValidAmount()
    {
        $searchForm = $this->formFactory->create(PaymentType::class);
        $searchForm->submit([
            'amountMin' => 12,
            'amountMax' => 13,
        ]);

        $this->assertTrue($searchForm->isValid());
    }

    public function testSubmitWithNotValidAmount()
    {
        $searchForm = $this->formFactory->create(PaymentType::class);
        $searchForm->submit([
            'amountMin' => 'testFrom',
            'amountMax' => 'testTo',
        ]);

        $this->assertNotTrue($searchForm->isValid());
    }

    public function testSubmitWithProvider()
    {
        $searchForm = $this->formFactory->create(PaymentType::class);
        $searchForm->submit([
            'provider' => 'testName'
        ]);
        $this->assertTrue($searchForm->isValid());
    }

    public function testSubmitWithStatusCode()
    {
        $searchForm = $this->formFactory->create(PaymentType::class);
        $searchForm->submit([
            'statusCode' => 'test'
        ]);

        $this->assertTrue($searchForm->isValid());
    }

}
