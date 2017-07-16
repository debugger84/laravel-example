<?php

namespace App\Http\Controllers;

use App\Entity\Client;
use App\Http\Request\ClientRequest;
use App\Repository\ClientRepository;
use App\Repository\Filter\ClientFilter;
use Illuminate\Http\JsonResponse;

class MainController extends Controller
{
    public function clientsPage()
    {
        return view('clients', compact('clients'));
    }

    public function listClients(ClientRepository $repository)
    {
        $clients = $repository->findAllClients(new ClientFilter());

        return view('clients-list', compact('clients'));
    }

    public function addClient(ClientRequest $clientRequest, ClientRepository $repository)
    {
        $client = new Client();
        $client->exchangeArray($clientRequest->all());
        $repository->saveClient($client);

        return new JsonResponse(['success' => true]);
    }

    public function updateClient(ClientRequest $clientRequest, $id, ClientRepository $repository)
    {
        $filter = new ClientFilter();
        $filter->setId($id);
        $client = $repository->findOneClient($filter);
        if (!$client) {
            return new JsonResponse(['errors' => ['The client is absent in the system.']], 400);
        }
        $client->exchangeArray($clientRequest->all());

        $repository->saveClient($client);

        return new JsonResponse(['success' => true]);
    }

    public function deleteClient($id, ClientRepository $repository)
    {
        $filter = new ClientFilter();
        $filter->setId($id);
        $client = $repository->findOneClient($filter);
        if ($client) {
            $repository->deleteClient($client);
        }

        return new JsonResponse(['success' => true]);
    }
}
