<?php

namespace Api\Common\UI\Response;

use Api\Common\UI\DataTransferObject\JsonSerializableInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class JsonResponseFactory
{
    /**
     * @param int                       $httpCode
     * @param JsonSerializableInterface $dataTransferObject
     * @param array                     $headers
     *
     * @return JsonResponse
     */
    public function createJsonResponseFromJsonSerializable($httpCode, JsonSerializableInterface $dataTransferObject, array $headers = array())
    {
        return new JsonResponse(
            $dataTransferObject->serialize(),
            $httpCode,
            $headers
        );
    }
    /**
     * @param int    $httpCode
     * @param string $errorDescription
     * @param string $errorProperty
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createErrorJsonResponseForProperty($httpCode, $errorDescription, $errorProperty, array $headers = array())
    {
        $data = array(
            'error' => array(
                'code' => $httpCode,
                'description' => $errorDescription,
                'property' => $errorProperty
            )
        );

        return new JsonResponse(
            $data,
            $httpCode,
            $headers
        );
    }
}
