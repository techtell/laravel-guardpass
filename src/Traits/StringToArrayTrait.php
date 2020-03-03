<?php

namespace Techtell\LaravelGuardPass\Traits;

use Techtell\LaravelGuardPass\Helpers\StringList;

trait StringToArrayTrait
{
    /**
     * Process filters string or return deafaults 
     */
    public function StringToArray(string $filters = null): array
    {
        return is_null($filters) ? $this->getDefaults() : $this->toArray($filters);
    }

    /**
     * 
     */
    public function toArray($filterString)
    {
        return $this->newArray(StringList::createArray($filterString));
    }

    /**
     * 
     */
    public abstract function getDefaults();

    /**
     * 
     */
    public function newArray($array)
    {
        return array_unique(array_merge(['id'], $array));
    }
}


