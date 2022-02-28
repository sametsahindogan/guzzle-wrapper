<?php

namespace Sametsahindogan\GuzzleWrapper\Builder;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Sametsahindogan\GuzzleWrapper\Interfaces\HTTPRequest;

/**
 * Class ApiCallBuilder
 * @package Sametsahindogan\GuzzleWrapper
 */
class ApiCallBuilder implements HTTPRequest
{
    /** @var string */
    const HTTP_GET = 'GET';

    /** @var string */
    const HTTP_POST = 'POST';

    /** @var string */
    const HTTP_PUT = 'PUT';

    /** @var string */
    const HTTP_PATCH = 'PATCH';

    /** @var string */
    const HTTP_DELETE = 'DELETE';

    /** @var string $apiUrl */
    protected $apiUrl;

    /** @var string $method */
    protected $method;

    /** @var string $uri */
    protected $uri = '/';

    /** @var array $body */
    protected $body = [];

    /** @var string $rawBody */
    protected $rawBody;

    /** @var array $formParams */
    protected $formParams = [];

    /** @var array $multipart */
    protected $multipart = [];

    /** @var array $headers */
    protected $headers = [];

    /** @var array $queryString */
    protected $queryString = [];

    /** @var Request $request */
    protected $request;

    /** @var Client $httpClient */
    protected $httpClient;

    /**
     * ApiCallBuilder constructor.
     * @param string $url
     * @param string $uri
     * @param string $method
     */
    public function __construct(string $url, string $uri, string $method = self::HTTP_POST)
    {
        $this->apiUrl = $url;
        $this->method = $method;
        $this->httpClient = new Client();
        $this->uri = $uri;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function method(string $method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function uri(string $uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function body(array $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param string $rawBody
     * @return $this
     */
    public function rawBody(string $rawBody)
    {
        $this->rawBody = $rawBody;
        return $this;
    }

    /**
     * @param array $formParams
     * @return $this
     */
    public function formParams(array $formParams)
    {
        $this->formParams = $formParams;
        return $this;
    }

    /**
     * @param array $multipart
     * @return $this
     */
    public function multipart(array $multipart)
    {
        $this->multipart = $multipart;
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function header(array $header)
    {
        $this->headers = array_merge($this->headers, $header);
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function bearerToken(string $token)
    {
        $this->headers['Authorization'] = 'Bearer ' . $token;
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function basicAuthentication(string $token)
    {
        $this->headers['Authorization'] = 'Basic ' . $token;
        return $this;
    }

    /**
     * @param array $queryString
     * @return $this
     */
    public function queryString(array $queryString)
    {
        $this->queryString = $queryString;
        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function call()
    {
        try {
            $data = ['headers' => $this->headers];

            if (!empty($this->body)) {
                $data["json"] = $this->body;

            }
            if (!empty($this->formParams)) {
                $data["form_params"] = $this->formParams;

            }
            if (!empty($this->multipart)) {
                $data["multipart"] = $this->multipart;

            }
            if (!empty($this->queryString)) {
                $data["query"] = $this->queryString;
            }
            if (!empty($this->rawBody)) {
                $data["body"] = $this->rawBody;
            }

            return $this->httpClient->request($this->method, $this->apiUrl . $this->uri, $data);

        } catch (ClientException|GuzzleException $e) {

            return $e->getResponse();

        }

    }


}
