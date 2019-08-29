<?php

namespace App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations;

use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

/**
 * Class OperationInterface
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
interface OperationInterface
{
    const SERIALIZATION_CONTEXT_SENTIMENT = 'sentiment';

    const SERIALIZATION_CONTEXT_LANGUAGES = 'languages';

    const SERIALIZATION_CONTEXT_KEYPHRASES = 'keyphrases';

    const SERIALIZATION_CONTEXT_ENTITIES = 'entities';

    const SERIALIZATION_CONTEXT_MS_AZURE = 'msa';

    public function getMethod();

    public function getSerializationContext();

    public function getEndPoint();

    public function getSubscriptionKey();

    public function getResource();

    public function getUri();

    public function getQuery();

    public function getOptions(Serializer $serializer);

    public function getHeaders();

    public function getResponse(ResponseInterface $response, Serializer $serializer);
}
