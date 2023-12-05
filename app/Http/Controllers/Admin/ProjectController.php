<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Function\Helper;
use App\http\Requests\ProjectRequest;
use App\Models\Tecnology;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET["toSearch"])){
            $projects = Project::where("name", "LIKE", "%" . $_GET["toSearch"] . "%")->paginate(25);
        }else{
            $projects = Project::orderBy("creation_date", "Desc")->paginate(25);
        }

        $direction = "desc";

        return view("admin.projects.index", compact("projects","direction"));
    }

    public function orderBy($direction, $column){
        $direction = $direction == "desc"? "asc" : "desc";
        $projects = Project::orderBy($column, $direction)->paginate(25);
        return view("admin.projects.index", compact("projects", "direction"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = "Inserimento nuovo progetto";
        $method = "POST";
        $route = route("admin.projects.store");
        $project = null;
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view("admin.projects.create-edit", compact("name", "method", "route", "project", "types", "tecnologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        $form_data["slug"] = Helper::generateSlug($form_data["name"], Project::class);
        $form_data["creation_date"] = date("Y-m-d");

        if(array_key_exists("image", $form_data)) {
            $form_data["image_original_name"] = $request->file("image")->getClientOriginalName();
            $form_data["image"] = Storage::put("uploads", $form_data["image"]);
        }

        $new_project = Project::create($form_data);

        if(array_key_exists("tecnologies", $form_data)){
            $new_project->tecnologies()->attach($form_data["tecnologies"]);
        }

        return redirect()->route("admin.projects.show", $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $name = "Modifica progetto";
        $method = "PUT";
        $route = route('admin.projects.update', $project);
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.create-edit', compact("name","method", "route", "project", "types", "tecnologies"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        if($form_data["name"]!= $project->name){
            $form_data["name"] = Helper::generateSlug($form_data["name"], Project::class);
        }else{
            $form_data["slug"] = $project->slug;
        }

        if(array_key_exists("image", $form_data)){
            if($project->image){
                Storage::disk("public")->delete($project->image);
            }

            $form_data["image_original_name"] = $request->file("image")->getClientOriginalName();
            $form_data["image"] = Storage::put("uploads", $form_data["image"]);
        }

        $form_data["date"] = date("Y-m-d");

        if(array_key_exists("tecnologies", $form_data)){
            $project->tecnologies()->sync($form_data["tecnologies"]);
        }else{
            $project->tecnologies()->detach();
        }

        $project->update($form_data);
        return redirect()->route("admin.projects.show", $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->image){
            Storage::disk("public")->delete($project->image);
        }


        $project->delete();
        return redirect()->route("admin.projects.index")->with("success", "Il progetto è stato eliminato correttamente");
    }
}
