<?php

namespace App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations;

use App\MicrosoftAzure\Response\MSAzureResponse;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\InstagramComment;

/**
 * Class KeyPhrasesOperation
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class KeyPhrasesOperation implements OperationInterface
{
    use TraitOperation;

    /**
     * @return string
     */
    public function getMethod()
    {
        return Request::METHOD_POST;
    }

    /**
     * @return string
     */
    public function getSerializationContext()
    {
        return OperationInterface::SERIALIZATION_CONTEXT_KEYPHRASES;
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return '/text/analytics/v2.1/keyPhrases';
    }

    /**
     * @param Serializer $serializer
     *
     * @return array
     */
    public function getOptions(Serializer $serializer)
    {
        return ['body' => $serializer->serialize(
            ['documents' => $this->instaPosts],
            'json',
            SerializationContext::create()->setGroups(OperationInterface::SERIALIZATION_CONTEXT_MS_AZURE)
        )];
    }

    /**
     * @param ResponseInterface $response
     * @param Serializer        $serializer
     *
     * @return InstagramComment[]|array
     */
    public function getResponse(ResponseInterface $response, Serializer $serializer)
    {
        $instaPosts = $serializer->deserialize(
            json_encode(json_decode($response->getBody()->getContents(), true)),
            MSAzureResponse::class,
            'json',
            DeserializationContext::create()->setGroups($this->getSerializationContext()));

        return $this->instaPosts;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return ['showStats' => 'true'];
    }
}
