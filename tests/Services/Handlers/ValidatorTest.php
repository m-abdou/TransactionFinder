<?php

use App\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValidatorTest extends KernelTestCase
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
        $this->validatorHandler = $kernel->getContainer()->get('service.handler.validator');
    }

    public function testIsValidateTrue()
    {
        $this->form->submit(['amountMin' =>20 , 'amountMax' => 40]);
        $this->assertTrue($this->validatorHandler->isValidate($this->form));
    }

    public function testIsValidateNotTrue()
    {
        $this->form->submit(['amountMin' =>'test' , 'amountMax' => 40]);
        $this->assertNotTrue($this->validatorHandler->isValidate($this->form));
    }

    public function testOperateWithError()
    {
        $this->form->submit(['amountMax' =>'test']);
        $error = $this->validatorHandler->notValidResponse($this->form);
        $this->assertEquals($error['errors']['amountMax'][0], 'This value is not valid.');
    }
}
