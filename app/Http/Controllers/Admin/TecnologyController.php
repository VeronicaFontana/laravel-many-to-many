<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tecnology;
use Illuminate\Support\Str;
use App\Function\Helper;

class TecnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnologies = Tecnology::all();
        return view("admin.tecnologies.index", compact("tecnologies"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = Tecnology::where("name", $request->name)->first();

        if($exist){
            return redirect()->route("admin.tecnologies.index")->with("error", "Tecnologia già presente");
        }else{
            $new_tecnology = new Tecnology();
            $new_tecnology->name = $request->name;
            $new_tecnology->slug = Str::slug($request->name, "-");
            $new_tecnology->save();

            return redirect()->route("admin.tecnologies.index")->with("success", "Tecnologia creata correttamente");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tecnology $tecnology)
    {
        $val_data = $request->validate([
            "name" => "required|min:2|max:20",
        ],[
            "name.required" => 'Devi inserire il nome della tecnologia',
            "name.min" => 'Il nome della tecnologia deve essere minimo 2 caratteri',
            "name.max" => 'Il nome della tecnologia deve essere massimo 20 caratteri'
        ]);

        $exixts = Tecnology::where("name", $request->name)->first();
        if($exixts){
            return redirect()->route("admin.tecnologies.index")->with("error", "Tecnologia già presente");
        }

        $val_data["slug"] = Helper::generateSlug($request->name, Tecnology::class);
        $tecnology->update($val_data);

        return redirect()->route("admin.tecnologies.index")->with("success", "Tecnologia aggiornata con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tecnology $tecnology)
    {
        $tecnology->delete();
        return redirect()->route("admin.tecnologies.index")->with("success", "Hai eliminato con successo la tecnologia");
    }
}
