<?php

namespace AppBundle\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonSerializer
{
    /**
     * @param $object
     * $object must be a array or a instance of a Object
     * @return bool|float|int|string
     * Returns generated Json
     */
    public function JsonSerializerAction($object)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $jsonMessage = $serializer->serialize($object, 'json');

        return $jsonMessage;
    }
}