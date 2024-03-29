<?php

namespace TheBachtiarz\Toolkit\Helper\App\Converter;

trait ArrayHelper
{
    /**
     * Result collection to single key array data
     *
     * @param array $arrayData
     * @param string $objectKey
     * @return array
     * @deprecated 1.1.7 use getValuesCollections() instead
     */
    private static function collectionToSingle(array $arrayData, string $objectKey): array
    {
        $_newCollection = [];

        foreach ($arrayData as $key => $object)
            $_newCollection[] = $object[$objectKey];

        return $_newCollection;
    }

    /**
     * Get value only from collection(s).
     *
     * @param mixed $collections
     * @param string $objectKey
     * @return array|null
     */
    private static function getValuesCollections(mixed $collections, string $objectKey): ?array
    {
        try {
            $_result = [];

            foreach ($collections as $key => $object)
                $_result[] = $object[$objectKey];

            return $_result;
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Encode data to string (json)
     *
     * @param mixed $data
     * @return string
     */
    private static function jsonEncode(mixed $data): string
    {
        return json_encode($data);
    }

    /**
     * Decode string to origin data
     *
     * @param string $data
     * @param boolean $associative
     * @return mixed
     */
    private static function jsonDecode(string $data, $associative = true)
    {
        return json_decode($data, $associative);
    }

    /**
     * Convert to string
     *
     * @param mixed $value
     * @return string|null
     */
    private static function serialize(mixed $value): ?string
    {
        return serialize($value);
    }

    /**
     * Convert to original data
     *
     * @param string $value
     * @return mixed
     */
    private static function unserialize(string $value)
    {
        return unserialize($value);
    }
}
