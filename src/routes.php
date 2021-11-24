<?php

use Petrik\Rajzfilmek\Rajzfilm;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app) {
    $app->get('/rajzfilmek', function(Request $request, Response $response){
        $rajzfilmek = Rajzfilm::all();
        $kimenet = $rajzfilmek->toJson();
        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-type', 'application/json');
    });

    $app->post('/rajzfilmek', function(Request $request, Response $response){
        $input = json_decode($request->getBody(), true);
        // Bemenet validáció. egy másik órán... :(
        $rajzfilm = new Rajzfilm();
        $rajzfilm->setAttributes($input);
        $rajzfilm->uj();

        $kimenet = json_encode($rajzfilm);
        $response->getBody()->write($kimenet);
        return $response
        ->withStatus(201)
        ->withHeader('Content-type', 'application/json');
    });

    $app->delete('/rajzfilmek/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID-nak pozitív egész számnak kell lennie!']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(400);
        }
        $rajzfilm = Rajzfilm::getById($args['id']);
        if ($rajzfilm === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(404);
        }

        $rajzfilm->torles();
        return $response->withHeader('Content-type', 'application/json')->withStatus(204);
    });

    $app->put('/rajzfilmek/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id' <= 0]) {
            $ki = json_encode(['error' => 'Az ID-nak pozitív egész számnak kell lennie!']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(400);
        }
        $rajzfilm = Rajzfilm::getById($args['id']);
        $rajzfilm->modositas();
        return $response->withHeader('Content-type', 'application/json')->withStatus(204);
    });
};