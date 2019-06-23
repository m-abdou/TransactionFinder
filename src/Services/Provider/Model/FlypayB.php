<?php

namespace App\Services\Provider\Model;

use JMS\Serializer\Annotation as Serializer;

class FlypayB extends Payment
{
    /**
     * @var string
     * @Serializer\SerializedName("transactionCurrency")
     * @Serializer\SerializedName("transactionCurrency")
     * @Serializer\Type("string")
     */
    protected $currency;

    /**
     * @var float
     * @Serializer\SerializedName("value")
     * @Serializer\Type("float")
     */
    protected $amount;

    /**
     * @var int
     * @Serializer\SerializedName("statusCode")
     * @Serializer\Type("integer")
     */
    protected $statusCode;

    /**
     * @var string
     * @Serializer\SerializedName("orderInfo")
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var string
     * @Serializer\SerializedName("paymentId")
     * @Serializer\Type("string")
     */
    protected $transactionId;

    protected $provider = "flypayB";


    /**
     * getStatusCode
     *
     * @return string
     *
     */
    public function getStatusCode(): string
    {
        switch ($this->statusCode) {
            case 100 :
                $value = 'authorised';
                break;
            case 200 :
                $value = 'decline';
                break;
            case 300 :
                $value = 'refunded';
                break;
        }

        $this->statusCode = $value;

        return $this->statusCode;
    }
}
