<?php

namespace App\Controller;

use App\Model\AccessoryManager;
use App\Model\CupcakeManager;
use App\Service\Container;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcake = array_map('trim', $_POST);
            $cupcakeService = new Container();
            $cupcakeService->firstCupcakeFormFilter($cupcake);
            $cupcakeService->secondCupcakeFormFilter($cupcake);
            $errors = $cupcakeService->errors;

            if (empty($errors)) {
                $cupcakeManager = new CupcakeManager();
                $cupcakeManager->addCupcake($cupcake);

                header('Location:/cupcake/list');
            } else {
                return $this->twig->render('cupcake/add.html.twig', [
                    'errors' => $errors,
                    'accessories' => $accessories
                ]);
            }
        }
        return $this->twig->render('Cupcake/add.html.twig', ['accessories' => $accessories]);
    }

    /**
     * Display list of cupcakes
     * Route /cupcake/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectCupcake();
        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }

    public function show(int $id)
    {
        $cupcakeManager = new CupcakeManager();
        $cupcake = $cupcakeManager->selectOneCupcake($id);
        return $this->twig->render('Cupcake/show.html.twig', ['cupcake' => $cupcake]);
    }
}
