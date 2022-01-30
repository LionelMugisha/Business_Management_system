<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NotifyAdmins;
use Illuminate\Support\Facades\Notification;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.client.index', ['clients' => Client::latest()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;
        $client->company_id = $request['company_id'];
        $client->name = $request['name'];
        $client->surname = $request['surname'];
        $client->address = $request['address'];
        $client->telephone = $request['telephone'];
        $client->save();

        $admin = User::where('name', 'admin')->get();

        $notificationData = [
            'body' => 'A new client called ' . $client['name'] .' '. $employee['surname'] . ' has been created!'
        ];
        Notification::send($admin, new NotifyAdmins($notificationData));
        
        return redirect('/client')->with('success', 'Client created successfully!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.client.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingClient = Client::find($id);
        if ($existingClient) {
            $existingClient->company_id = $request['company_id'];
            $existingClient->name = $request['name'];
            $existingClient->surname = $request['surname'];
            $existingClient->address = $request['address'];
            $existingClient->telephone = $request['telephone'];
            $existingClient->save();
        }
        return redirect('/client')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Client Deleted successfully!');
    }
}
