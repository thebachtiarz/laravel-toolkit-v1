<?php

namespace TheBachtiarz\Toolkit\Helper\App\Converter;

trait ArrayHelper
{
    /**
     * result collection to single key array data
     *
     * @param array $arrayData
     * @param string $objectKey
     * @return array
     */
    public static function collectionToSingle(array $arrayData, string $objectKey): array
    {
        $_newCollection = [];

        foreach ($arrayData as $key => $object)
            $_newCollection[] = $object[$objectKey];

        return $_newCollection;
    }

    /**
     * encode array to string
     *
     * @param array $data
     * @return string
     */
    public static function jsonEncode(array $data): string
    {
        return json_encode($data);
    }

    /**
     * decode string to array associative
     *
     * @param string $data
     * @param boolean $associative
     * @return array
     */
    public static function jsonDecode(string $data, $associative = true): array
    {
        return json_decode($data, $associative);
    }

    /**
     * convert to string
     *
     * @param mixed $value
     * @return string|null
     */
    public static function serialize($value): ?string
    {
        return serialize($value);
    }

    /**
     * convert to original data
     *
     * @param string $value
     * @return mixed|null
     */
    public static function unserialize(string $value): ?mixed
    {
        return unserialize($value);
    }
}
