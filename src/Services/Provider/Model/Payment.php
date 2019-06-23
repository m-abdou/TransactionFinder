<?php

namespace App\Services\Provider\Model;
use JMS\Serializer\Annotation as Serializer;


class Payment
{
    /**
     * @var string
     * @Serializer\Type("float")
     */
    protected $currency;

    /**
     * @var float
     * @Serializer\Type("float")
     */
    protected $amount;

    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    protected $statusCode;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $provider;

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    /**
     * @param int $status
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }


    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId(string $transactionId): void
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     */
    public function setProvider(string $provider): void
    {
        $this->provider = $provider;
    }

}
