<?php

namespace App\Services;

use App\Services\Handlers\Loader;
use App\Services\Handlers\Operator;
use App\Services\Handlers\Validator;
use Symfony\Component\Form\Form;

class Manager
{



    private $validator;

    private $loader;

    private $operator;

    /**
     * Manager constructor.
     *
     * @param \App\Services\Handlers\Validator $validator
     * @param \App\Services\Handlers\Loader    $loader
     * @param \App\Services\Handlers\Operator  $operator
     */
    public function __construct(Validator $validator, Loader $loader, Operator $operator)
    {
        $this->validator = $validator;
        $this->loader = $loader;
        $this->operator = $operator;
    }

    /**
     * manage request for query validation and execute it
     * @param Form $form
     * @return array
     */
    public function operate(Form $form)
    {

        if($this->validator->isValidate($form)){
            $this->operator->setTransactions($this->loader->load());
            return $this->operator->searchByQuery($form->getData());
        }

        return $this->validator->notValidResponse($form);
    }


}
