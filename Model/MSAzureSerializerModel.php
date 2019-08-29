<?php

namespace App\MicrosoftAzure\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MSAzureSerializerModel
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class MSAzureSerializerModel
{
    /**
     * @Serializer\Type("integer")
     * @Serializer\Groups({"sentiment", "languages", "keyphrases", "entities"})
     */
    private $id;

    /**
     * @Serializer\Type("float")
     * @Serializer\Groups({"sentiment"})
     * @Serializer\SerializedName("score")
     */
    private $score;

    /**
     * @Serializer\Type("array<App\MicrosoftAzure\Model\DetectedLanguageModel>")
     * @Serializer\Groups({"languages"})
     * @Serializer\SerializedName("detectedLanguages")
     */
    private $detectedLanguages;

    /**
     * @Serializer\Type("array<string>")
     * @Serializer\Groups({"keyphrases"})
     * @Serializer\SerializedName("keyPhrases")
     */
    private $keyPhrases;

    /**
     * @Serializer\Type("array<App\MicrosoftAzure\Model\EntityModel>")
     * @Serializer\Groups({"entities"})
     * @Serializer\SerializedName("entities")
     */
    private $entities;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return mixed
     */
    public function getDetectedLanguages()
    {
        return $this->detectedLanguages;
    }

    /**
     * @return mixed
     */
    public function getKeyPhrases()
    {
        return $this->keyPhrases;
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->entities;
    }
}
