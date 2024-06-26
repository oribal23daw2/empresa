<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ControladorClient extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dades_clients = Client::all();
        return view('llista-clients', compact('dades_clients'));
    }

    public function index_basic(){
        $dades_clients = Client::all();
        return view('llista-basica', compact('dades_clients'));
    }
    
    public function create()
    {
        return view('crear-client');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $nouClient = $request->validate([
        'DNI' => 'required|unique:clients',
        'Noms' => 'required',
        'Edat' => 'required',
        'Telèfon' => 'required',
        'Adreça' => 'required',
        'Ciutat' => 'required',
        'País' => 'required',
        'Email' => 'required',
        'Número_permís_conducció' => 'required',
        'Punts_permís_conducció' => 'required',
        'Tipus_targeta' => 'required',
        'Número_targeta' => 'required',
    ]);

    $client = Client::create($nouClient);

    return redirect('clients');
}


    /**
     * Display the specified resource.
     */
    public function show($DNI)
    {
        $dades_client = Client::findOrFail($DNI);
        return view('mostra', compact('dades_client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit($DNI)
    {
        $dades_client = Client::findOrFail($DNI);
        return view('actualitza', compact('dades_client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $DNI)
    {
        // Validar los datos del formulario
        $noves_dades_client = $request->validate([
            'DNI' => 'required|unique:clients,DNI,'.$DNI.',DNI',
            'Noms' => 'required',
            'Edat' => 'required',
            'Telèfon' => 'required',
            'Adreça' => 'required',
            'Ciutat' => 'required',
            'País' => 'required',
            'Email' => 'required',
            'Número_permís_conducció' => 'required',
            'Punts_permís_conducció' => 'required',
            'Tipus_targeta' => 'required',
            'Número_targeta' => 'required',
        ]);
    
        Client::findOrFail($DNI)->update($noves_dades_client);
    
        return redirect('clients');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request, $DNI)
    {
        $client = Client::findOrFail($DNI)->delete();
        $request->session()->flash('success', '¡Esborrat correctament!');
        return redirect('clients');
    }

}