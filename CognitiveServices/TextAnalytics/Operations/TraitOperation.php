<?php

namespace App\MicrosoftAzure\CognitiveServices\TextAnalytics\Operations;

use App\Entity\InstagramComment;

/**
 * Trait TraitOperation
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
trait TraitOperation
{

    /**
     * @var InstagramComment[]
     */
    private $instaPosts;

    /**
     * @var bool
     */
    private $buildQuery;

    /**
     * TraitOperation constructor.
     *
     * @param InstagramComment[] $instaPosts
     * @param bool               $buildQuery
     */
    public function __construct(array $instaPosts, bool $buildQuery)
    {
        $this->instaPosts = $instaPosts;
        $this->buildQuery = $buildQuery;
    }

    /**
     * @return array|false|string
     */
    public function getEndPoint()
    {
        return getenv('MSA_ADWTA_URL');
    }

    /**
     * @return array|false|string
     */
    public function getSubscriptionKey()
    {
        return getenv('MSA_ADWTA_KEY');
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->getEndPoint().$this->getResource();
    }

    /**
     * @return bool
     */
    public function isBuildQuery(): bool
    {
        return $this->buildQuery;
    }

}
