<?php

namespace App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations;

use App\MicrosoftAzure\Exceptions\MSAzureClientException;
use App\MicrosoftAzure\Model\MSAzureSerializerModel;
use App\MicrosoftAzure\Response\MSAzureResponse;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\InstagramComment;

/**
 * Class SentimentOperation
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class SentimentOperation implements OperationInterface
{
    use TraitOperation;

    const INSTA_MOODS = [
        'negative' => ['proportion' => 33, 'mood' => InstagramComment::MOOD_NEGATIVE],
        'neutral' => ['proportion' => 66, 'mood' => InstagramComment::MOOD_NEUTRAL],
        'positive' => ['proportion' => 100, 'mood' => InstagramComment::MOOD_POSITIVE],
    ];

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
        return OperationInterface::SERIALIZATION_CONTEXT_SENTIMENT;
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return '/text/analytics/v2.1/sentiment';
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

        if (\count($instaPosts->getErrors()) > 0) {
            foreach ($instaPosts->getErrors() as $error) {
                throw new MSAzureClientException($error->getMessage());
            }
        }

        /** @var MSAzureSerializerModel $item */
        foreach ($instaPosts->getDocuments() as $item) {
            /** @var InstagramComment $instaPost */
            foreach ($this->instaPosts as $instaPost) {
                if ($instaPost->getId() === $item->getId()) {
                    $score = \intval(\round($item->getScore(), 1, PHP_ROUND_HALF_UP) * 100);
                    if (
                        $score <= self::INSTA_MOODS['negative']['proportion']
                    ) {
                        $instaPost->setMood(self::INSTA_MOODS['negative']['mood']);
                    } elseif (
                        $score > self::INSTA_MOODS['negative']['proportion'] &&
                        $score <= self::INSTA_MOODS['neutral']['proportion']
                    ) {
                        $instaPost->setMood(self::INSTA_MOODS['neutral']['mood']);
                    } elseif (
                        $score > self::INSTA_MOODS['neutral']['proportion'] &&
                        $score <= self::INSTA_MOODS['positive']['proportion']
                    ) {
                        $instaPost->setMood(self::INSTA_MOODS['positive']['mood']);
                    }
                }
            }
        }

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
