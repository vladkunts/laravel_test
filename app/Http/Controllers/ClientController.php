<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $client = new Client;
        $client->firstname = $request->firstname;
        $client->lastname = $request->lastname;
        $client->email = $request->email;
        $path = $request->file('avatar')->store('public');
        $path = str_replace("public", "storage", $path);
        $client->avatar = $path;
        $client->save();

        return back()
            ->with('success','Client has been created.');
    }

    /**
     * Display the specified client.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display client list for autocomplete search on Edit page
     */
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = Client::where(\DB::raw('concat(firstname," ",lastname)') , 'LIKE' , '%'. $query. '%')->limit(5)->get();
          $result = [];
          foreach($filterResult as $client){
            $result[] = [
                "id" => $client->id,
                "name" => "{$client->firstname} {$client->lastname}"
            ];
          }
          return response()->json($result);
    } 

    /**
     * Show the form for editing the specified client.
     */
    public function edit(string $id)
    {
        return view('clients.edit')->with('client', Client::find($id));
    }

    /**
     * Update the specified client in storage (if some fields changed).
     */
    public function update(UpdateClientRequest $request, string $id)
    {
        $client = Client::find($id);
        if($request->firstname)
            $client->firstname = $request->firstname;
        if($request->lastname)
            $client->lastname = $request->lastname;
        if($request->email)
            $client->email = $request->email;
        if($request->file('avatar'))
        {
            $path = $request->file('avatar')->store('public');
            $path = str_replace("public", "storage", $path);
            $client->avatar = $path;
        }
        $client->save();

        return back()
            ->with('success','Client has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Client::find($id)->delete();
        return back();
    }
}
