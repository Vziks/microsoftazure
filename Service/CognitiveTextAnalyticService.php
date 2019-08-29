<?php

namespace App\MicrosoftAzure\Service;

use App\Entity\InstagramComment;
use App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations\EntitiesOperation;
use App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations\KeyPhrasesOperation;
use App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations\LanguagesOperation;
use App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations\SentimentOperation;
use App\MicrosoftAzure\MicrosoftAzureApiHandler;

/**
 * Class CognitiveTextAnalyticService
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class CognitiveTextAnalyticService
{
    private $microSoftHandler;

    /**
     * CognitiveTextAnalyticService constructor.
     *
     * @param MicrosoftAzureApiHandler $microSoftHandler
     */
    public function __construct(MicrosoftAzureApiHandler $microSoftHandler)
    {
        $this->microSoftHandler = $microSoftHandler;
    }

    /**
     * @param array $instagramComments
     * @param bool  $query
     *
     * @return InstagramComment[]|array
     */
    public function getSentimentText(array $instagramComments, bool $query = false)
    {
        $result = $this->microSoftHandler->request(
            new SentimentOperation($instagramComments, $query)
        );

        return $result;
    }

    /**
     * @param array $instagramComments
     * @param bool  $query
     *
     * @return InstagramComment[]|array
     */
    public function getLanguagesText(array $instagramComments, bool $query = false)
    {
        $result = $this->microSoftHandler->request(
            new LanguagesOperation($instagramComments, $query)
        );

        return $result;
    }

    /**
     * @param array $instagramComments
     * @param bool  $query
     *
     * @return InstagramComment[]|array
     */
    public function getKeyPhrasesText(array $instagramComments, bool $query = false)
    {
        $result = $this->microSoftHandler->request(
            new KeyPhrasesOperation($instagramComments, $query)
        );

        return $result;
    }

    /**
     * @param array $instagramComments
     * @param bool  $query
     *
     * @return InstagramComment[]|array
     */
    public function getEntitiesText(array $instagramComments, bool $query = false)
    {
        $result = $this->microSoftHandler->request(
            new EntitiesOperation($instagramComments, $query)
        );

        return $result;
    }
}
