<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // return view('chirps.index', ['chirps' => Chirp::all()->sortByDesc('created_at')]);
    // Con with('user') se hace una consulta adicional para traer los datos del usuario que creó el chirp
    return view('chirps.index', ['chirps' => Chirp::with('user')->latest()->get()]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'message' => 'required|max:255|min:3'
    ]);
    // Se trae el usuario autenticado, se llama al método chirps() creado en el modelo User y se crea un chirp con los datos validados
    $request->user()->chirps()->create($validated);

    /* Chirp::create([
      'message' => $request['message'],
      'user_id' => auth()->id()
    ]);
 */
    // session()->flash('status', '¡Chirp creado!');
    // return back()->with('status', '¡Chirp creado!');
    return to_route('chirps.index')->with('status', '¡Chirp creado!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Chirp $chirp)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Chirp $chirp)
  {

    // Verificar si el usuario autenticado es el dueño del chirp
    $this->authorize('update', $chirp);

    return view('chirps.editar', ['chirp' => $chirp]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Chirp $chirp)
  {
    // Verificar si el usuario autenticado es el dueño del chirp
    $this->authorize('update', $chirp);

    $validated = $request->validate([
      'message' => 'required|max:255|min:3'
    ]);
    $chirp->update($validated);
    return redirect()->route('chirps.index')->with('status', '¡Chirp actualizado!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Chirp $chirp)
  {
    // Verificar si el usuario autenticado es el dueño del chirp
    $this->authorize('delete', $chirp);

    $chirp->delete();
    return redirect()->route('chirps.index')->with('status', '¡Chirp eliminado!');
  }
}
