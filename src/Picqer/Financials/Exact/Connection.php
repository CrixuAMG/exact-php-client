<?php namespace Picqer\Financials\Exact;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Class Connection
 * @package Picqer\Financials\Exact
 */
class Connection
{

    /**
     * @var string
     */
    private $apiUrl = 'https://start.exactonline.nl/api/v1';
    /**
     * @var string
     */
    private $authUrl = 'https://start.exactonline.nl/api/oauth2/auth';
    /**
     * @var string
     */
    private $tokenUrl = 'https://start.exactonline.nl/api/oauth2/token';

    /**
     * @var
     */
    private $exactClientId;
    /**
     * @var
     */
    private $exactClientSecret;
    /**
     * @var
     */
    private $authorizationCode;
    /**
     * @var
     */
    private $accessToken;

    /**
     * @var
     */
    private $tokenExpires;

    /**
     * @var
     */
    private $refreshToken;
    /**
     * @var
     */
    private $redirectUrl;
    /**
     * @var
     */
    private $division;

    /**
     * @var Client
     */
    private $client;

    /**
     * @return Client
     */
    private function client()
    {
        if ($this->client) {
            return $this->client;
        }

        $this->client = new Client([
            'http_errors' => true,
        ]);

        return $this->client;
    }

    public function connect()
    {
        // Redirect for authorization if needed (no access token or refresh token given)
        if ($this->needsAuthentication()) {
            $this->redirectForAuthorization();
        }

        // If access token is not set or token has expired, acquire new token
        if (empty($this->accessToken) || $this->tokenHasExpired()) {
            $this->acquireAccessToken();
        }

        $client = $this->client();

        return $client;
    }

    /**
     * @param string $method
     * @param $endpoint
     * @param null $body
     * @param array $params
     * @param array $headers
     * @return Request
     */
    private function createRequest($method = 'GET', $endpoint, $body = null, array $params = [], array $headers = [])
    {
        // Add default json headers to the request
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        // If access token is not set or token has expired, acquire new token
        if (empty($this->accessToken) || $this->tokenHasExpired()) {
            $this->acquireAccessToken();
        }

        // If we have a token, sign the request
        if (!$this->needsAuthentication() && !empty($this->accessToken)) {
            $headers['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        // Create param string
        if (!empty($params)) {
            $endpoint .= '?' . http_build_query($params);
        }

        // Create the request
        $request = new Request($method, $endpoint, $headers, $body);

        return $request;
    }

    /**
     * @param $url
     * @param array $params
     * @return mixed
     * @throws ApiException
     */
    public function get($url, array $params = [])
    {
        $url = $this->formatUrl($url, $url !== 'current/Me');

        $request = $this->createRequest('GET', $url, null, $params);

        $response = $this->client()->send($request);

        return $this->parseResponse($response);
    }

    /**
     * @param $url
     * @param $body
     * @return mixed
     * @throws ApiException
     */
    public function post($url, $body)
    {
        $url = $this->formatUrl($url);

        try {
            $request  = $this->createRequest('POST', $url, $body);
            $response = $this->client()->send($request);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return $this->parseResponse($response);
    }

    /**
     * @param $url
     * @param $body
     * @return mixed
     * @throws ApiException
     */
    public function put($url, $body)
    {
        $url = $this->formatUrl($url);

        $request  = $this->createRequest('PUT', $url, $body);
        $response = $this->client()->send($request);

        return $this->parseResponse($response);
    }

    /**
     * @param $url
     * @return mixed
     * @throws ApiException
     */
    public function delete($url)
    {
        $url = $this->formatUrl($url);

        $request  = $this->createRequest('DELETE', $url);
        $response = $this->client()->send($request);

        return $this->parseResponse($response);
    }

    /**
     * @return string
     */
    private function getAuthUrl()
    {
        return $this->authUrl . '?' . http_build_query(array(
            'client_id' => $this->exactClientId,
            'redirect_uri' => $this->redirectUrl,
            'response_type' => 'code'
        ));
    }

    /**
     * @param mixed $exactClientId
     */
    public function setExactClientId($exactClientId)
    {
        $this->exactClientId = $exactClientId;
    }

    /**
     * @param mixed $exactClientSecret
     */
    public function setExactClientSecret($exactClientSecret)
    {
        $this->exactClientSecret = $exactClientSecret;
    }

    /**
     * @param mixed $authorizationCode
     */
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param mixed $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }


    /**
     *
     */
    public function redirectForAuthorization()
    {
        $authUrl = $this->getAuthUrl();
        header('Location: ' . $authUrl);
        exit;
    }

    /**
     * @param mixed $redirectUrl
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return bool
     */
    public function needsAuthentication()
    {
        return empty($this->refreshToken) && empty($this->authorizationCode);
    }

    /**
     * @param Response $response
     * @return mixed
     * @throws ApiException
     */
    private function parseResponse(Response $response)
    {
        try {
            $json = json_decode($response->getBody()->getContents(), true);
            if (array_key_exists('d', $json)) {
                if (array_key_exists('results', $json['d'])) {
                    if (count($json['d']['results']) == 1) {
                        return $json['d']['results'][0];
                    }

                    return $json['d']['results'];
                }

                return $json['d'];
            }

            return $json;
        } catch (\RuntimeException $e) {
            throw new ApiException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    private function getCurrentDivisionNumber()
    {
        if (empty($this->division)) {
            $me             = new Me($this);
            $this->division = $me->find()->CurrentDivision;
        }

        return $this->division;
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    private function acquireAccessToken()
    {
        // If refresh token not yet acquired, do token request
        if (empty($this->refreshToken)) {
            $body = [
                'form_params' => [
                    'redirect_uri' => $this->redirectUrl,
                    'grant_type' => 'authorization_code',
                    'client_id' => $this->exactClientId,
                    'client_secret' => $this->exactClientSecret,
                    'code' => $this->authorizationCode
                ]
            ];
        } else { // else do refresh token request
            $body = [
                'form_params' => [
                    'refresh_token' => $this->refreshToken,
                    'grant_type' => 'refresh_token',
                    'client_id' => $this->exactClientId,
                    'client_secret' => $this->exactClientSecret,
                ]
            ];
        }

        $response = $this->client()->post($this->tokenUrl, $body);

        if ($response->getStatusCode() == 200) {
            $body = json_decode($response->getBody()->getContents(), true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->accessToken  = $body['access_token'];
                $this->refreshToken = $body['refresh_token'];
                $this->tokenExpires = $this->getDateTimeFromExpires($body['expires_in']);
            } else {
                throw new ApiException('Could not acquire tokens, json decode failed. Got response: ' . $response->getBody()->getContents());
            }
        } else {
            throw new ApiException('Could not acquire or refresh tokens');
        }
    }


    private function getDateTimeFromExpires($expires)
    {
        if (!is_numeric($expires)) {
            throw new \InvalidArgumentException('Function requires a numeric expires value');
        }

        return time() + 600;
    }

    /**
     * @return mixed
     */
    public function getTokenExpires()
    {
        return $this->tokenExpires;
    }

    /**
     * @param mixed $tokenExpires
     */
    public function setTokenExpires($tokenExpires)
    {
        $this->tokenExpires = $tokenExpires;
    }

    private function tokenHasExpired()
    {
        if (empty($this->tokenExpires)) {
            return true;
        }

        return $this->tokenExpires <= time();
    }

    private function formatUrl($endPoint, $includeDivision = true)
    {
        if ($includeDivision) {
            return implode('/', [
                $this->apiUrl,
                $this->getCurrentDivisionNumber(),
                $endPoint
            ]);
        }

        return implode('/', [
            $this->apiUrl,
            $endPoint
        ]);
    }


    /**
     * @return mixed
     */
    public function getDivision()
    {
        return $this->division;
    }


    /**
     * @param mixed $division
     */
    public function setDivision($division)
    {
        $this->division = $division;
    }

}


