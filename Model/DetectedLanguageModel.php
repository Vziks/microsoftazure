<?php

namespace App\MicrosoftAzure\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class DetectedLanguageModel
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class DetectedLanguageModel
{
    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"languages"})
     */
    private $name;

    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"languages"})
     * @Serializer\SerializedName("iso6391Name")
     */
    private $iso6391Name;

    /**
     * @Serializer\Type("integer")
     * @Serializer\Groups({"languages"})
     * @Serializer\SerializedName("score")
     */
    private $score;

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
    public function getIso6391Name()
    {
        return $this->iso6391Name;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }
}
