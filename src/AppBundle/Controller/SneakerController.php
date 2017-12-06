<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sneaker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp;
use GuzzleHttp\Client;

class SneakerController extends Controller {

    public function listAllAction() {

        $client = new Client();
        $response = $client->request('GET', 'http://feetzi/sneakers.json');

        $array_sneakers = array();
        if (200 == $response->getStatusCode()) {
            $array_sneakers = GuzzleHttp\json_decode($response->getBody(), true);
        }

        return $this->render('list.html.twig', array(
                    'array_sneakers' => $array_sneakers,
        ));
    }

}
