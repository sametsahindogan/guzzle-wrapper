<?php

namespace Sametsahindogan\GuzzleWrapper\Builder;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiResponse
 * @package Sametsahindogan\GuzzleWrapper
 */
class ApiResponse
{
    /** @var int $statusCode */
    protected $statusCode = 200;

    /** @var mixed $data */
    protected $data;

    /**
     * ApiResponse constructor.
     */
    public function __construct(ResponseInterface $response)
    {
        $this->data = json_decode($response->getBody()->getContents());
        $this->statusCode = $response->getStatusCode();
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

}
