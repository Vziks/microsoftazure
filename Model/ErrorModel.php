<?php

namespace App\MicrosoftAzure\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ErrorModel
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class ErrorModel
{
    /**
     * @var int
     * @Serializer\Type("integer")
     * @Serializer\Groups({"sentiment", "languages", "keyphrases", "entities"})
     */
    private $id;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Groups({"sentiment", "languages", "keyphrases", "entities"})
     */
    private $message;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}
