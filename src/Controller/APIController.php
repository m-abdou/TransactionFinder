<?php

namespace App\Controller;

use App\Form\PaymentType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations AS Rest;

/**
 * Class APIController
 * @package App\Controller
 * @Rest\Route("/api")
 */
class APIController extends FOSRestController
{

    /**
     * @Rest\Get("/payment/transaction")
     * @param Request $request
     * @return json
     */
    public function getPaymentTransactionAction(Request $request)
    {

        $manager = $this->get('service.manager');
        $apiHelper = $this->get('service.apiHelper');
        $searchForm = $this->createForm(PaymentType::class);
        $searchForm->submit($request->query->all());
        $data = $manager->operate($searchForm);

        if($data['status'] == true){
            $view = $apiHelper->getSuccessView($data);
        }else{
            $view = $apiHelper->getErrorView($data);
        }

        return $this->handleView($view);
    }
}
