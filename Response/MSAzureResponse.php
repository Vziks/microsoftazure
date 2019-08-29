<?php

namespace App\MicrosoftAzure\Response;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MSAzureResponse
 * Project platform.
 *
 * @author  Anton Prokhorov <vziks@live.ru>
 */
class MSAzureResponse
{
    /**
     * @Serializer\Type("array<App\MicrosoftAzure\Model\ErrorModel>")
     * @Serializer\Groups({"sentiment", "languages", "keyphrases", "entities"})
     */
    private $errors;

    /**
     * @Serializer\Type("array<App\MicrosoftAzure\Model\MSAzureSerializerModel>")
     * @Serializer\Groups({"sentiment", "languages", "keyphrases", "entities"})
     */
    private $documents;

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}
