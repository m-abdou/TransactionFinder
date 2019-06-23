<?php

namespace App\Services\Provider\Model;

use JMS\Serializer\Annotation as Serializer;

class FlypayA extends Payment
{
    /**
     * @var string
     * @Serializer\SerializedName("currency")
     * @Serializer\Type("string")
     */
    protected $currency;

    /**
     * @var float
     * @Serializer\SerializedName("amount")
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
     * @Serializer\SerializedName("orderReference")
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var string
     * @Serializer\SerializedName("transactionId")
     * @Serializer\Type("string")
     */
    protected $transactionId;

    protected $provider= "flypayA";


    /**
     * getStatus
     *
     * @return string
     *
     */
    public function getStatus(): string
    {
        switch ($this->statusCode) {
            case 1 :
                $value = 'authorised';
                break;
            case 2 :
                $value = 'decline';
                break;
            case 3 :
                $value = 'refunded';
                break;
        }

        $this->statusCode = $value;
        return $this->statusCode;
    }

}
