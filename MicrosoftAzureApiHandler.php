<?php

namespace App\MicrosoftAzure;

use App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations\OperationInterface;
use App\MicrosoftAzure\Exceptions\MSAzureClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\SerializationContext;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class MicrosoftAzureApiHandler
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class MicrosoftAzureApiHandler
{
    private $logger;

    /**
     * MicrosoftAzureApiHandler constructor.
     *
     * @param $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function request(OperationInterface $operation)
    {
        $client = new Client([
            'timeout' => 10,
        ]);

        $request = new Request(
            $operation->getMethod(),
            $this->decorateUri($operation),
            $this->decorateHeaders($operation)
        );

        $options = $this->decorateRequest($operation);

        try {
            $this->logger->debug(json_encode($options), [
                (string) $request->getUri(),
            ]);

            $response = $client->send($request, $options);

            $this->logger->debug($response->getBody()->getContents());
        } catch (ConnectException $e) {
            $this->logger->error(json_encode($e->getMessage()));
            throw new MSAzureClientException($e);
        } catch (\Exception $e) {
            $this->logger->error(json_encode($e->getMessage()));
            throw new MSAzureClientException($e);
        } catch (GuzzleException $e) {
            $this->logger->error(json_encode($e->getMessage()));
        }

        $response->getBody()->rewind();

        return $this->handleResponse($response, $operation);
    }

    private function decorateRequest(OperationInterface $operation)
    {
        $options = [];

        $options = array_merge_recursive($options, $operation->getOptions($this->getSerializer()));

        return $options;
    }

    private function decorateHeaders(OperationInterface $operation)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $operation->getSubscriptionKey(),
        ];

        $headers = array_merge_recursive($headers, $operation->getHeaders());

        return $headers;
    }

    private function decorateUri(OperationInterface $operation)
    {
        return $operation->getUri().(\count($operation->getQuery()) > 0 ? '?'.http_build_query($operation->getQuery()) : '');
    }

    /**
     * @param ResponseInterface  $response
     * @param OperationInterface $operation
     *
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response, OperationInterface $operation)
    {
        $serializer = $this->getSerializer();

        return $operation->getResponse($response, $serializer);
    }

    final public static function getSerializer()
    {
        return \JMS\Serializer\SerializerBuilder::create()
            ->setSerializationContextFactory(function () {
                return SerializationContext::create()
                    ->setSerializeNull(true)
                    ;
            })
            ->build()
        ;
    }
}
