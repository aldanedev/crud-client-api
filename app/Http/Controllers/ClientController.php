<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function save(Request $request)
    {
        $client = new \App\Models\Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->enrollment = $request->enrollment;
        $client->date_payment = $request->date_payment;
        $client->save();

        return response()->json($client, 201);
    }

    public function list()
    {
        $clients = \App\Models\Client::all();
        return response()->json($clients, 200);
    }

    public function update(Request $request, $id)
    {
        $client = \App\Models\Client::find($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->enrollment = $request->enrollment;
        $client->date_payment = $request->date_payment;
        $client->save();
        return response()->json($client, 200);
    }

    public function delete($id)
    {
        $client = \App\Models\Client::find($id);
        $client->delete();
        return response()->json(null, 204);
    }

}
