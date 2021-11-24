<?php

use Petrik\Rajzfilmek\Kategoria;
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
        $rajzfilm = Rajzfilm::create($input);
        $rajzfilm->save();

        $kimenet = $rajzfilm->toJson();
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
        $rajzfilm = Rajzfilm::find($args['id']);
        if ($rajzfilm === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(404);
        }

        $rajzfilm->delete();
        return $response->withHeader('Content-type', 'application/json')->withStatus(204);
    });

    $app->put('/rajzfilmek/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID-nak pozitív egész számnak kell lennie!']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(400);
        }
        $rajzfilm = Rajzfilm::find($args['id']);
        if ($rajzfilm === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(404);
        }

        $input = json_decode($request->getBody(), true);
        $rajzfilm->fill($input);
        $rajzfilm->save();
        $response->getBody()->write($rajzfilm->toJson());
        return $response->withHeader('Content-type', 'application/json')->withStatus(200);
    });

    $app->get('/rajzfilmek/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID-nak pozitív egész számnak kell lennie!']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(400);
        }
        $rajzfilm = Rajzfilm::find($args['id']);
        if ($rajzfilm === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(404);
        }

        $response->getBody()->write($rajzfilm->toJson());
        return $response->withHeader('Content-type', 'application/json')->withStatus(200);
    });


    

    $app->get('/kategoriak', function(Request $request, Response $response){
        $kategoria = Kategoria::all();
        $kimenet = $kategoria->toJson();
        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-type', 'application/json');
    });

    $app->post('/kategoriak', function(Request $request, Response $response){
        $input = json_decode($request->getBody(), true);
        // Bemenet validáció. egy másik órán... :(
        $kategoria = Kategoria::create($input);
        $kategoria->save();

        $kimenet = $kategoria->toJson();
        $response->getBody()->write($kimenet);
        return $response
        ->withStatus(201)
        ->withHeader('Content-type', 'application/json');
    });

    $app->delete('/kategoriak/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID-nak pozitív egész számnak kell lennie!']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(400);
        }
        $kategoria = Kategoria::find($args['id']);
        if ($kategoria === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(404);
        }

        $kategoria->delete();
        return $response->withHeader('Content-type', 'application/json')->withStatus(204);
    });

    $app->put('/kategoriak/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID-nak pozitív egész számnak kell lennie!']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(400);
        }
        $kategoria = Kategoria::find($args['id']);
        if ($kategoria === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(404);
        }

        $input = json_decode($request->getBody(), true);
        $kategoria->fill($input);
        $kategoria->save();
        $response->getBody()->write($kategoria->toJson());
        return $response->withHeader('Content-type', 'application/json')->withStatus(200);
    });

    $app->get('/kategoriak/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID-nak pozitív egész számnak kell lennie!']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(400);
        }
        $kategoria = Kategoria::find($args['id']);
        if ($kategoria === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
            $response->getBody()->write($ki);
            return $response->withHeader('Content-type', 'application/json')->withStatus(404);
        }

        $response->getBody()->write($kategoria->toJson());
        return $response->withHeader('Content-type', 'application/json')->withStatus(200);
    });
};