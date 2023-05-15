<?php

namespace App\Service;

class Container
{
    public array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function firstAccessoryFormFilter(array $accessory): void
    {
        if (!isset($accessory['name']) || empty($accessory['name'])) {
            $this->errors[] = "Pensez au nom de l'accessoire";
        }

        if (!isset($accessory['url']) || empty($accessory['url'])) {
            $this->errors[] = "Pensez à l'url de l'accessoire";
        }
    }

    public function secondAccessoryFormFilter(array $accessory): void
    {
        if (isset($accessory['name']) && strlen($accessory['name']) > 255) {
            $this->errors[] = "Le nom est trop long";
        }

        if (isset($accessory['url']) && strlen($accessory['url']) > 255) {
            $this->errors[] = "L'url est trop long";
        }

        if (!empty($accessory['url']) && filter_var($accessory['url'], FILTER_VALIDATE_URL) === false) {
            $this->errors[] = "l'url n'est pas valide";
        }
    }

    public function firstCupcakeFormFilter(array $cupcake): void
    {
        if (!isset($cupcake['name']) || empty($cupcake['name'])) {
            $this->errors[] = "Pensez au nom du cupcake";
        }

        if (!isset($cupcake['color1']) || empty($cupcake['color1'])) {
            $this->errors[] = "Pensez à la couleur 1 du cupcake";
        }

        if (!isset($cupcake['color2']) || empty($cupcake['color2'])) {
            $this->errors[] = "Pensez à couleur 2 du cupcake";
        }

        if (!isset($cupcake['color3']) || empty($cupcake['color3'])) {
            $this->errors[] = "Pensez à la couleur 3 du cupcake";
        }
    }

    public function secondCupcakeFormFilter(array $cupcake): void
    {
        if (!isset($cupcake['accessory'])) {
            $this->errors[] = "Pensez à à choisir un accéssoire";
        }

        if (isset($cupcake['name']) && strlen($cupcake['name']) > 255) {
            $this->errors[] = "Le nom est trop long";
        }
    }
}
