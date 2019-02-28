<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends ApiController
{
    public function __construct()
    {
        //$this->middleware('scope:read-general')->only('show');
        $this->middleware('can:view,client')->only('show'); 
    }

    public function index()
    {
        $clientes = Client::all();
        return $this->showAll($clientes);
    }
    
    public function show(Client $client)
    {
        Log::info($client);
        return $this->showOne($client);
    }

    public function store(Request $request)
    {
        //
    }

   
    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
    }
}
