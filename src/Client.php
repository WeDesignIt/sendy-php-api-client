<?php

namespace WeDesignIt\Sendy;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var string
     */
    //protected string $baseUrl = 'https://portal.keendelivery.com/api/v3/';
    // will become:
    protected string $baseUrl = 'https://app.sendy.nl/api/';

    /**
     * @var GuzzleClient
     */
    protected GuzzleClient $client;

    /**
     * Personal access tokens may be requested from the user profile section in Sendy.
     *
     * @var string
     */
    private string $token;

    /**
     * Client constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;

        $this->client = new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
                'User-Agent' => 'sendy-php-api-client/1.0 (github.com/wedesignit/sendy-php-api-client)',
            ],
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return array|string Array if the response was JSON, raw response body otherwise.
     * @throws GuzzleException
     */
    public function request(
        string $method,
        string $uri,
        array $options = []
    ): array|string
    {
        $response = $this->rawRequest($method, $uri, $options);

        $contents = $response->getBody()->getContents();

        // fallback to application/json as this is, the default return type
        $default = 'application/json';
        if (stristr(($response->getHeader('Content-Type')[0] ?? $default), 'application/json') !== false) {
            $array = json_decode($contents, true);

            return (array) $array;
        } else {
            return $contents;
        }
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function rawRequest(
        string $method,
        string $uri,
        array $options = []
    ): ResponseInterface
    {
        return $this->client->request($method, $uri, $options);
    }
}