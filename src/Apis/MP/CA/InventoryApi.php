<?php

/**
 * InventoryApi
 * PHP version 7.4
 *
 * @category Class
 * @package  Walmart
 * @author   Jesse Evers
 * @link     https://highsidelabs.co
 */

/**
 * Inventory Management
 *
 * This class is auto-generated by the OpenAPI generator v6.6.0 (https://openapi-generator.tech).
 * Do not edit the class manually.
 */

namespace Walmart\Apis\MP\CA;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use Walmart\Apis\BaseApi;
use Walmart\ApiException;
use Walmart\ObjectSerializer;

/**
 * InventoryApi Class Doc Comment
 *
 * @category Class
 * @package  Walmart
 * @author   Jesse Evers
 * @link     https://highsidelabs.co
 * @email    jesse@highsidelabs.co
 */
class InventoryApi extends BaseApi
{
    /**
     * @var string[] $contentTypes
     */
    public const contentTypes = [
        'getInventory' => 'application/json',
        'updateBulkInventory' => 'multipart/form-data',
        'updateInventoryForAnItemCA' => 'application/xml',
    ];

    /**
     * Operation getInventory
     *
     * Inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, which identifies each item. This will be used by the seller in the XSD file to refer to each item. (required)
     *
     * @throws \Walmart\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Walmart\Models\MP\CA\Inventory\InventoryV2
     */
    public function getInventory(
        string $sku
    ): \Walmart\Models\MP\CA\Inventory\InventoryV2 {
        return $this->getInventoryWithHttpInfo($sku);
    }

    /**
     * Operation getInventoryWithHttpInfo
     *
     * Inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, which identifies each item. This will be used by the seller in the XSD file to refer to each item. (required)
     *
     * @throws \Walmart\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Walmart\Models\MP\CA\Inventory\InventoryV2
     */
    protected function getInventoryWithHttpInfo(
        string $sku,
    ): \Walmart\Models\MP\CA\Inventory\InventoryV2 {
        $request = $this->getInventoryRequest($sku);
        $this->writeDebug($request);
        $this->writeDebug((string) $request->getBody());

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
                $this->writeDebug($response);
                $this->writeDebug((string) $response->getBody());
            } catch (RequestException $e) {
                $hasResponse = !empty($e->hasResponse());
                $body = (string) ($hasResponse ? $e->getResponse()->getBody() : '[NULL response]');
                $this->writeDebug($e->getResponse());
                $this->writeDebug($body);

                throw new ApiException(
                    "[{$e->getCode()}] {$body}",
                    (int) $e->getCode(),
                    $hasResponse ? $e->getResponse()->getHeaders() : null,
                    $body
                );
            } catch (ConnectException $e) {
                $this->writeDebug($e->getMessage());

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }
            switch ($statusCode) {
                case 200:
                    if ('\Walmart\Models\MP\CA\Inventory\InventoryV2' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Walmart\Models\MP\CA\Inventory\InventoryV2' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return ObjectSerializer::deserialize($content, '\Walmart\Models\MP\CA\Inventory\InventoryV2', $response->getHeaders());
            }

            $returnType = '\Walmart\Models\MP\CA\Inventory\InventoryV2';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Walmart\Models\MP\CA\Inventory\InventoryV2',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }

            $this->writeDebug($e);
            throw $e;
        }
    }

    /**
     * Operation getInventoryAsync
     *
     * Inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, which identifies each item. This will be used by the seller in the XSD file to refer to each item. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getInventoryAsync(
        string $sku
    ): PromiseInterface {
        return $this->getInventoryAsyncWithHttpInfo($sku)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getInventoryAsyncWithHttpInfo
     *
     * Inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, which identifies each item. This will be used by the seller in the XSD file to refer to each item. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    protected function getInventoryAsyncWithHttpInfo(
        string $sku,
    ): PromiseInterface {
        $returnType = '\Walmart\Models\MP\CA\Inventory\InventoryV2';
        $request = $this->getInventoryRequest($sku);
        $this->writeDebug($request);
        $this->writeDebug((string) $request->getBody());

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $this->writeDebug($response);
                    $this->writeDebug((string) $response->getBody());
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $hasResponse = !empty($response);
                    $body = (string) ($hasResponse ? $response->getBody() : '[NULL response]');
                    $this->writeDebug($response);
                    $statusCode = $hasResponse ? $response->getStatusCode() : $exception->getCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $body,
                    );
                }
            );
    }

    /**
     * Create request for operation 'getInventory'
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, which identifies each item. This will be used by the seller in the XSD file to refer to each item. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getInventoryRequest(
        string $sku,
    ): Request {
        $contentType = self::contentTypes['getInventory'];

        // verify the required parameter 'sku' is set
        if ($sku === null || (is_array($sku) && count($sku) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sku when calling getInventory'
            );
        }
        $resourcePath = '/v3/ca/inventory';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        $method = 'GET';

        // query params
        $queryParams = array_merge(
            ObjectSerializer::toQueryValue(
                $sku,
                'sku', // param base name
                'string', // openApiType
                'form', // style
                true, // explode
                true // required
            ) ?? [],
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/xml'],
            $contentType,
            $multipart
        );

        $defaultHeaders = parent::getDefaultHeaders();
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        $channelTypeSchemeApiKey = $this->config->getApiKey('channelTypeScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($channelTypeSchemeApiKey !== null) {
            $headers['WM_CONSUMER.CHANNEL.TYPE'] = $channelTypeSchemeApiKey;
        }

        $signatureSchemeApiKey = $this->config->getApiKey('signatureScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($signatureSchemeApiKey !== null) {
            $headers['WM_SEC.AUTH_SIGNATURE'] = $signatureSchemeApiKey;
        }

        $consumerIdSchemeApiKey = $this->config->getApiKey('consumerIdScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($consumerIdSchemeApiKey !== null) {
            $headers['WM_CONSUMER.ID'] = $consumerIdSchemeApiKey;
        }

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            $method,
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateBulkInventory
     *
     * Bulk update
     *
     * @param  string $feedType Includes details of each entity in the feed. Do not set this parameter to true. (required)
     * @param  \SplFileObject $file Feed file to upload (required)
     *
     * @throws \Walmart\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Walmart\Models\MP\CA\Inventory\FeedId
     */
    public function updateBulkInventory(
        string $feedType,
        \SplFileObject $file
    ): \Walmart\Models\MP\CA\Inventory\FeedId {
        return $this->updateBulkInventoryWithHttpInfo($feedType, $file);
    }

    /**
     * Operation updateBulkInventoryWithHttpInfo
     *
     * Bulk update
     *
     * @param  string $feedType Includes details of each entity in the feed. Do not set this parameter to true. (required)
     * @param  \SplFileObject $file Feed file to upload (required)
     *
     * @throws \Walmart\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Walmart\Models\MP\CA\Inventory\FeedId
     */
    protected function updateBulkInventoryWithHttpInfo(
        string $feedType,
        \SplFileObject $file,
    ): \Walmart\Models\MP\CA\Inventory\FeedId {
        $request = $this->updateBulkInventoryRequest($feedType, $file);
        $this->writeDebug($request);
        $this->writeDebug((string) $request->getBody());

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
                $this->writeDebug($response);
                $this->writeDebug((string) $response->getBody());
            } catch (RequestException $e) {
                $hasResponse = !empty($e->hasResponse());
                $body = (string) ($hasResponse ? $e->getResponse()->getBody() : '[NULL response]');
                $this->writeDebug($e->getResponse());
                $this->writeDebug($body);

                throw new ApiException(
                    "[{$e->getCode()}] {$body}",
                    (int) $e->getCode(),
                    $hasResponse ? $e->getResponse()->getHeaders() : null,
                    $body
                );
            } catch (ConnectException $e) {
                $this->writeDebug($e->getMessage());

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }
            switch ($statusCode) {
                case 200:
                    if ('\Walmart\Models\MP\CA\Inventory\FeedId' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Walmart\Models\MP\CA\Inventory\FeedId' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return ObjectSerializer::deserialize($content, '\Walmart\Models\MP\CA\Inventory\FeedId', $response->getHeaders());
            }

            $returnType = '\Walmart\Models\MP\CA\Inventory\FeedId';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Walmart\Models\MP\CA\Inventory\FeedId',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }

            $this->writeDebug($e);
            throw $e;
        }
    }

    /**
     * Operation updateBulkInventoryAsync
     *
     * Bulk update
     *
     * @param  string $feedType Includes details of each entity in the feed. Do not set this parameter to true. (required)
     * @param  \SplFileObject $file Feed file to upload (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateBulkInventoryAsync(
        string $feedType,
        \SplFileObject $file
    ): PromiseInterface {
        return $this->updateBulkInventoryAsyncWithHttpInfo($feedType, $file)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateBulkInventoryAsyncWithHttpInfo
     *
     * Bulk update
     *
     * @param  string $feedType Includes details of each entity in the feed. Do not set this parameter to true. (required)
     * @param  \SplFileObject $file Feed file to upload (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    protected function updateBulkInventoryAsyncWithHttpInfo(
        string $feedType,
        \SplFileObject $file,
    ): PromiseInterface {
        $returnType = '\Walmart\Models\MP\CA\Inventory\FeedId';
        $request = $this->updateBulkInventoryRequest($feedType, $file);
        $this->writeDebug($request);
        $this->writeDebug((string) $request->getBody());

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $this->writeDebug($response);
                    $this->writeDebug((string) $response->getBody());
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $hasResponse = !empty($response);
                    $body = (string) ($hasResponse ? $response->getBody() : '[NULL response]');
                    $this->writeDebug($response);
                    $statusCode = $hasResponse ? $response->getStatusCode() : $exception->getCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $body,
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateBulkInventory'
     *
     * @param  string $feedType Includes details of each entity in the feed. Do not set this parameter to true. (required)
     * @param  \SplFileObject $file Feed file to upload (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function updateBulkInventoryRequest(
        string $feedType,
        \SplFileObject $file,
    ): Request {
        $contentType = self::contentTypes['updateBulkInventory'];

        // verify the required parameter 'feedType' is set
        if ($feedType === null || (is_array($feedType) && count($feedType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $feedType when calling updateBulkInventory'
            );
        }
        // verify the required parameter 'file' is set
        if ($file === null || (is_array($file) && count($file) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file when calling updateBulkInventory'
            );
        }
        $resourcePath = '/v3/ca/feeds';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        $method = 'POST';

        // query params
        $queryParams = array_merge(
            ObjectSerializer::toQueryValue(
                $feedType,
                'feedType', // param base name
                'string', // openApiType
                'form', // style
                true, // explode
                true // required
            ) ?? [],
        );

        // form params
        if ($file !== null) {
            $multipart = true;
            $formParams['file'] = [];
            $paramFiles = is_array($file) ? $file : [$file];
            foreach ($paramFiles as $paramFile) {
                $formParams['file'][] = \GuzzleHttp\Psr7\Utils::tryFopen(
                    ObjectSerializer::toFormValue($paramFile),
                    'rb'
                );
            }
        }

        $headers = $this->headerSelector->selectHeaders(
            ['application/xml'],
            $contentType,
            $multipart
        );

        $defaultHeaders = parent::getDefaultHeaders();
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        $channelTypeSchemeApiKey = $this->config->getApiKey('channelTypeScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($channelTypeSchemeApiKey !== null) {
            $headers['WM_CONSUMER.CHANNEL.TYPE'] = $channelTypeSchemeApiKey;
        }

        $signatureSchemeApiKey = $this->config->getApiKey('signatureScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($signatureSchemeApiKey !== null) {
            $headers['WM_SEC.AUTH_SIGNATURE'] = $signatureSchemeApiKey;
        }

        $consumerIdSchemeApiKey = $this->config->getApiKey('consumerIdScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($consumerIdSchemeApiKey !== null) {
            $headers['WM_CONSUMER.ID'] = $consumerIdSchemeApiKey;
        }

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            $method,
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateInventoryForAnItemCA
     *
     * Update inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, identifying each item. (required)
     * @param  \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2 File fields (required)
     *
     * @throws \Walmart\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Walmart\Models\MP\CA\Inventory\InventoryV2
     */
    public function updateInventoryForAnItemCA(
        string $sku,
        \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2
    ): \Walmart\Models\MP\CA\Inventory\InventoryV2 {
        return $this->updateInventoryForAnItemCAWithHttpInfo($sku, $inventoryV2);
    }

    /**
     * Operation updateInventoryForAnItemCAWithHttpInfo
     *
     * Update inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, identifying each item. (required)
     * @param  \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2 File fields (required)
     *
     * @throws \Walmart\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Walmart\Models\MP\CA\Inventory\InventoryV2
     */
    protected function updateInventoryForAnItemCAWithHttpInfo(
        string $sku,
        \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2,
    ): \Walmart\Models\MP\CA\Inventory\InventoryV2 {
        $request = $this->updateInventoryForAnItemCARequest($sku, $inventoryV2);
        $this->writeDebug($request);
        $this->writeDebug((string) $request->getBody());

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
                $this->writeDebug($response);
                $this->writeDebug((string) $response->getBody());
            } catch (RequestException $e) {
                $hasResponse = !empty($e->hasResponse());
                $body = (string) ($hasResponse ? $e->getResponse()->getBody() : '[NULL response]');
                $this->writeDebug($e->getResponse());
                $this->writeDebug($body);

                throw new ApiException(
                    "[{$e->getCode()}] {$body}",
                    (int) $e->getCode(),
                    $hasResponse ? $e->getResponse()->getHeaders() : null,
                    $body
                );
            } catch (ConnectException $e) {
                $this->writeDebug($e->getMessage());

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }
            switch ($statusCode) {
                case 200:
                    if ('\Walmart\Models\MP\CA\Inventory\InventoryV2' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Walmart\Models\MP\CA\Inventory\InventoryV2' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return ObjectSerializer::deserialize($content, '\Walmart\Models\MP\CA\Inventory\InventoryV2', $response->getHeaders());
            }

            $returnType = '\Walmart\Models\MP\CA\Inventory\InventoryV2';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Walmart\Models\MP\CA\Inventory\InventoryV2',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }

            $this->writeDebug($e);
            throw $e;
        }
    }

    /**
     * Operation updateInventoryForAnItemCAAsync
     *
     * Update inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, identifying each item. (required)
     * @param  \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2 File fields (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateInventoryForAnItemCAAsync(
        string $sku,
        \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2
    ): PromiseInterface {
        return $this->updateInventoryForAnItemCAAsyncWithHttpInfo($sku, $inventoryV2)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateInventoryForAnItemCAAsyncWithHttpInfo
     *
     * Update inventory
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, identifying each item. (required)
     * @param  \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2 File fields (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    protected function updateInventoryForAnItemCAAsyncWithHttpInfo(
        string $sku,
        \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2,
    ): PromiseInterface {
        $returnType = '\Walmart\Models\MP\CA\Inventory\InventoryV2';
        $request = $this->updateInventoryForAnItemCARequest($sku, $inventoryV2);
        $this->writeDebug($request);
        $this->writeDebug((string) $request->getBody());

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $this->writeDebug($response);
                    $this->writeDebug((string) $response->getBody());
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $hasResponse = !empty($response);
                    $body = (string) ($hasResponse ? $response->getBody() : '[NULL response]');
                    $this->writeDebug($response);
                    $statusCode = $hasResponse ? $response->getStatusCode() : $exception->getCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $body,
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateInventoryForAnItemCA'
     *
     * @param  string $sku An arbitrary alphanumeric unique ID, specified by the seller, identifying each item. (required)
     * @param  \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2 File fields (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function updateInventoryForAnItemCARequest(
        string $sku,
        \Walmart\Models\MP\CA\Inventory\InventoryV2 $inventoryV2,
    ): Request {
        $contentType = self::contentTypes['updateInventoryForAnItemCA'];

        // verify the required parameter 'sku' is set
        if ($sku === null || (is_array($sku) && count($sku) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sku when calling updateInventoryForAnItemCA'
            );
        }
        // verify the required parameter 'inventoryV2' is set
        if ($inventoryV2 === null || (is_array($inventoryV2) && count($inventoryV2) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $inventoryV2 when calling updateInventoryForAnItemCA'
            );
        }
        $resourcePath = '/v3/ca/inventory';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        $method = 'PUT';

        // query params
        $queryParams = array_merge(
            ObjectSerializer::toQueryValue(
                $sku,
                'sku', // param base name
                'string', // openApiType
                'form', // style
                true, // explode
                true // required
            ) ?? [],
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/xml'],
            $contentType,
            $multipart
        );

        $defaultHeaders = parent::getDefaultHeaders();
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        // for model (json/xml)
        if (isset($inventoryV2)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($inventoryV2));
            } else {
                $httpBody = $inventoryV2;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        $channelTypeSchemeApiKey = $this->config->getApiKey('channelTypeScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($channelTypeSchemeApiKey !== null) {
            $headers['WM_CONSUMER.CHANNEL.TYPE'] = $channelTypeSchemeApiKey;
        }

        $signatureSchemeApiKey = $this->config->getApiKey('signatureScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($signatureSchemeApiKey !== null) {
            $headers['WM_SEC.AUTH_SIGNATURE'] = $signatureSchemeApiKey;
        }

        $consumerIdSchemeApiKey = $this->config->getApiKey('consumerIdScheme', [
            'path' => $resourcePath,
            'method' => $method,
            'timestamp' => $defaultHeaders['WM_TIMESTAMP'],
        ]);
        if ($consumerIdSchemeApiKey !== null) {
            $headers['WM_CONSUMER.ID'] = $consumerIdSchemeApiKey;
        }

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            $method,
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }
}

