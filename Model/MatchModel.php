<?php

namespace App\MicrosoftAzure\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MatchModel
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class MatchModel
{
    /**
     * @Serializer\Type("float")
     * @Serializer\Groups({"entities"})
     */
    private $wikipediaScore;

    /**
     * @Serializer\Type("float")
     * @Serializer\Groups({"entities"})
     */
    private $entityTypeScore;

    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"entities"})
     */
    private $text;
    /**
     * @Serializer\Type("integer")
     * @Serializer\Groups({"entities"})
     */
    private $offset;
    /**
     * @Serializer\Type("integer")
     * @Serializer\Groups({"entities"})
     */
    private $length;

    /**
     * @return mixed
     */
    public function getWikipediaScore()
    {
        return $this->wikipediaScore;
    }

    /**
     * @return mixed
     */
    public function getEntityTypeScore()
    {
        return $this->entityTypeScore;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }
}
