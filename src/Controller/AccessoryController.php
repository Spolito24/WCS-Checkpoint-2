<?php

namespace App\Controller;

use App\Model\AccessoryManager;
use App\Service\Container;

/**
 * Class AccessoryController
 *
 */
class AccessoryController extends AbstractController
{
    /**
     * Display accessory creation page
     * Route /accessory/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accessory = array_map('trim', $_POST);
            $accessoryService = new Container();
            $accessoryService->firstAccessoryFormFilter($accessory);
            $accessoryService->secondAccessoryFormFilter($accessory);
            $errors = $accessoryService->errors;

            if (empty($errors)) {
                $accessoryManager = new AccessoryManager();
                $accessoryManager->addAccessory($accessory);

                header('Location:/accessory/list');
            } else {
                return $this->twig->render('Accessory/add.html.twig', ['errors' => $errors]);
            }
        }
        return $this->twig->render('Accessory/add.html.twig');
    }

    /**
     * Display list of accessories
     * Route /accessory/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();
        return $this->twig->render('Accessory/list.html.twig', ['accessories' => $accessories]);
    }
}
