<?php

use App\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ManagerTest extends WebTestCase
{

    /** @var \Symfony\Component\Form\FormFactory $formFactory */
    private $formFactory;

    private $form;

    public function setUp()
    {
        static::bootKernel();
        $kernel = static::$kernel;
        $this->formFactory = $kernel->getContainer()->get('form.factory');
        $this->form = $this->formFactory->create(PaymentType::class);
        $this->managerService = $kernel->getContainer()->get('service.manager');
    }

    public function testOperate()
    {
        $this->form->submit(['provider' => 'flypayA']);
        $transactions = $this->managerService->operate($this->form);
        $this->assertCount(9, $transactions['transactions']);
    }

    public function testOperateWithError()
    {
        $this->form->submit(['amountMax' =>'test']);
        $error = $this->managerService->operate($this->form);
        $this->assertEquals($error['errors']['amountMax'][0], 'This value is not valid.');
    }
}
