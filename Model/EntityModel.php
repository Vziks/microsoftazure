<?php

namespace App\MicrosoftAzure\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class EntityModel
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class EntityModel
{
    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $name;

    /**
     * @Serializer\Type("array<App\MicrosoftAzure\Model\MatchModel>")
     * @Serializer\Groups({"entities"})
     */
    private $matches;
    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $wikipediaLanguage;
    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $wikipediaId;
    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $wikipediaUrl;
    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $bingId;
    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $type;

    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $subType;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @return mixed
     */
    public function getWikipediaLanguage()
    {
        return $this->wikipediaLanguage;
    }

    /**
     * @return mixed
     */
    public function getWikipediaId()
    {
        return $this->wikipediaId;
    }

    /**
     * @return mixed
     */
    public function getWikipediaUrl()
    {
        return $this->wikipediaUrl;
    }

    /**
     * @return mixed
     */
    public function getBingId()
    {
        return $this->bingId;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getSubType()
    {
        return $this->subType;
    }
}
