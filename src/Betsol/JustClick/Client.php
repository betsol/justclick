<?php

namespace Betsol\JustClick;

use Guzzle\Http\ClientInterface;
use Betsol\JustClick\Entity\Order;
use Betsol\JustClick\Exception\IncorrectResponseException;
use Betsol\JustClick\Exception\IncorrectResponseHashException;
use Betsol\JustClick\Exception\RequestFailedException;


/**
 * Class Client
 * @package Betsol\JustClick
 * @author Slava Fomin II <s.fomin@betsol.ru>
 */
class Client
{
    protected $defaultConfig = [
        'url'      => 'http://{USERNAME}.justclick.ru/api/',
        'username' => '',
        'secret'   => '',
    ];

    /** @var  array */
    protected $config;

    /** @var  ClientInterface */
    protected $httpClient;

    protected $requiredResponseFields = [
        'error_code',
        'error_text',
        'hash',
        'result',
    ];


    /**
     * @param array $config
     * @param ClientInterface $httpClient
     */
    public function __construct(array $config = [], ClientInterface $httpClient)
    {
        $this->config = array_merge($this->defaultConfig, $config);
        $this->httpClient = $httpClient;

        $baseUrl = str_replace('{USERNAME}', $this->config['username'], $this->config['url']);
        $this->httpClient->setBaseUrl($baseUrl);
    }

    /**
     * Creates new order from specified parameters.
     *
     * @param Order $order
     * @return array|null
     */
    public function createOrder(Order $order)
    {
        return $this->sendRequest('CreateOrder', $order->getData());
    }

    /**
     * @param string $methodName
     * @param array $parameters
     * @return array|null
     */
    protected function sendRequest($methodName, array $parameters = [])
    {
        $parameters['hash'] = self::getRequestHash($parameters);

        $httpResponse = $this->httpClient
            ->post($methodName, null, $parameters)
            ->send()
        ;

        $responseBody = (string) $httpResponse->getBody();

        $response = json_decode($responseBody, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new IncorrectResponseException('Failed to parse response as JSON.');
        }

        // Making sure that response contains all the required fields.
        foreach ($this->requiredResponseFields as $field) {
            if (!array_key_exists($field, $response)) {
                throw new IncorrectResponseException;
            }
        }

        // Checking response hash.
        if ($response['hash'] != $this->getResponseHash($response['error_code'], $response['error_text'])) {
            throw new IncorrectResponseHashException;
        }

        // Checking if request succeeded.
        if (0 !== (int) $response['error_code']) {
            // Throwing generic exception for now.
            // @todo: create custom exception classes for all possible errors.
            throw new RequestFailedException($response['error_text'], $response['error_code']);
        }

        return $response['result'];
    }

    /**
     * @param array $parameters
     * @return string
     */
    protected function getRequestHash(array $parameters = [])
    {
        return md5(
            implode('::', [
                $this->urlEncode($parameters),
                $this->config['username'],
                $this->config['secret'],
            ])
        );
    }

    /**
     * @param int $errorCode
     * @param string $errorMessage
     * @return string
     */
    protected function getResponseHash($errorCode, $errorMessage)
    {
        return md5(
            implode('::', [
                $errorCode,
                $errorMessage,
                $this->config['secret'],
            ])
        );
    }

    /**
     * @param array $parameters
     * @return string
     */
    protected static function urlEncode(array $parameters)
    {
        return http_build_query($parameters);
    }
}