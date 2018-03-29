<?php


namespace App\Models\ValueObjects;


class Configuration
{

    private $configuration = "";

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public static function createInstance() {
        return [
            'allowed_per_year' => 1
        ];
    }




    public function toSerialize() {
        return serialize($this->configuration);
    }
}