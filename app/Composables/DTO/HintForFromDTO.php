<?php

namespace App\Composables\DTO;

use Illuminate\Http\Request;
use ReflectionException;

trait HintForFromDTO
{
    /**
     * @param array $array
     * @return static
     * @throws ReflectionException
     */
    public static function fromArray(array $array): static
    {
        return parent::fromArray($array);
    }

    /**
     * @param static $object
     * @return static
     * @throws ReflectionException
     */
    public static function fromObject($object): static
    {
        return parent::fromObject($object);
    }

    /**
     * @param Request $request
     * @return static
     * @throws ReflectionException
     */
    public static function fromRequest(Request $request): static
    {
        return parent::fromRequest($request);
    }

    /**
     * @param string $json
     * @return static
     * @throws ReflectionException
     */
    public static function fromJson(string $json): static
    {
        return parent::fromJson($json);
    }
}
