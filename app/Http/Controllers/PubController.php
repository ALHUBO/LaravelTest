<?php

namespace App\Http\Controllers;

use App\Models\Pub;
use Illuminate\Http\Request;

class PubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pubs.index',[
			//'pubs' => Pub::all() //orden normal
			//'pubs' => Pub::orderBy('created_at','desc')->get() //orden de ultimo a primero
			//'pubs' => Pub::latest()->get()//lo mismo que el anterior pero simple no optimo (una consulta por publicación)
			'pubs' => Pub::with('user')->latest()->get()//lo mismo per optimo
		]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

		/*$request->validate([
			//'publicacion'=>'required'
			'publi'=>['required','min:3','max:255']
		]);
		//!sin relacion en db
        //Pub::create([
		//	'publicacion'=> $request->get('publi'),//request('publi'), //directo en web.php
		//	'user_id'=> auth()->id()
		//]);
		//* auth()->user()->pubs()->create([ //igual al de abajo
		$request->user()->pubs()->create([
			'publicacion'=> $request->get('publi')
		]);

		//esto se puede resumir:
		*/

		//!Para ello se tiene que llamar el campo tag html name igual que en la db
		$validado=$request->validate([
			//'publicacion'=>'required'
			'publicacion'=>['required','min:3','max:255']
		]);

		$request->user()->pubs()->create($validado);

		//! se crea una varaible de session() y se indica que solo sea valida la proxima peticion luego desaparesca flash()
		//? se define sin valor
		// * session()->flash('status');
		//? se define con valor
		// * session()->flash('status','Publicación realizada');
		//! para resumir la devuelta de una variable de session directamente despues de to_route ->with
		return to_route('pubs.index')->with('status','Publicación realizada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pub $pub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
	* public function edit($pub)
    * {
	*	$pub=Pub::fingOrFail($pub);
    *	return $pub;
    * }
	! es lo mismo que esto:
	* public function edit(Pub $pub)
    * {
	*	$pub=Pub::fingOrFail($pub);
    *	return $pub;
    * }
	*/
	
	public function edit(Pub $pub){

		//if(auth()->user()->isNot($pub->user)) abort(403);
		$this->authorize('update',$pub);

		return view('pubs.edit',[
			"pub"=> $pub
		]);
	}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pub $pub)
    {
		//! para evitar esto y tener que editar multiples 
		//! y tambien para un admin que pueda editar todo 
		//! mejor utilizar politicas de acceso 
		//? > php artisan make:policy [Nombre]Policy --model=[Modelo]
		//* Se crea en /app/Policies/[Nombre]Policy.php
		//if(auth()->user()->isNot($pub->user)) abort(403);
		$this->authorize('update',$pub);

		$validado=$request->validate([
			//'publicacion'=>'required'
			'publicacion'=>['required','min:3','max:255']
		]);
		
		$pub->update($validado);
		return to_route('pubs.index')->with('status',__('Se actualizo exitosamente!!!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pub $pub)
    {
		$this->authorize('delete',$pub);

		$pub->delete();
        return to_route('pubs.index')->with('status',__('Se elimino correctamente!!!'));
    }
}
