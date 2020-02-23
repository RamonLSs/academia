<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Modulo;
use Illuminate\Http\Request;
use App\Http\Requests\AlumnoRequest;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulo::get('nombre');
        $alumnos = Alumno::orderBy('apellidos')
        ->paginate(5);
        return view('alumnos.index', compact('alumnos', 'modulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request)
    {
        $datos = $request->validated();
        //prepareForValidation(){}

        //cojo los datos por que voy a modificar el request
        //voy a poner nom y ape la primera letra en mayuscula

        $alumno=new Alumno();
        $alumno->nombre=ucwords($datos['nombre']);
        $alumno->apellidos=ucwords($datos['apellidos']);
        $alumno->mail=$datos['mail'];
        $alumno->logo = $datos['logo'];
        //dd($alumno);


        //comprobamos si hemos subido el logo
        if($datos['logo']!= null){

            $file=$datos['logo'];
            $nom = 'logo/'.time().' . '.$file->getClientOriginalName();
            //guardamos el fichero en public
            \Storage::disk('public')->put($nom, \File::get($file));
            //le damos a alumno el nombre que le hemos puesto al fichero
            $alumno->logo="img/$nom";
             //guardamos el alumno
            }

        $alumno->save();
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.detalle', compact('alumno'));
    }

    public function fmatricula(Alumno $alumno){
       $modulos2 = $alumno->modulosOut();
        //Compruebo si ya los tiene todos
        if($modulos2->count()==0){
            return redirect()->route('alumnos.show',$alumno)->with('mensaje', 'Este alumno ya esta matriculado de todos los modulos');
        }

        //cargamos el formulario matricular alumno le mando el alumno y los modulos que le faltan
        return view('alumnos.fmatricula',compact('alumno', 'modulos2'));
    }

    public function fcalificar(Alumno $alumno){
        $modulos = $alumno->modulos()->get();
        if($modulos->count()==0){
            return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'El alumno no cursa en ningun modulo');
        }
        return view('alumnos.fcalificar', compact('alumno'));
    }

    public function calificar(Request $request){
        $alumno = Alumno::find($request->id_al);
        //recorro el array asociativo con los id modulos y las notas
        foreach($request->modulos as $key=>$v){
            $alumno->modulos()->updateExistingPivot($key, ['nota'=>$v]);
        }
        return redirect()->route('alumnos.show', $alumno)->with("mensaje", "Calificaciones Guardadas");
    }

    public function matricular(Request $request){
        $id=$request->alumno_id;
        $alumno=Alumno::find($id);

        if(isset($request->modulo_id)){
            foreach ($request->modulo_id as $item) {
                $alumno->modulos()->attach($item);
            }
            return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Alumno matriculado correctamente');
        }
        return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Ningun modulo seleccioado');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre'=>['required'],
            'apellidos'=>['required'],
            'mail'=>['required','unique:alumnos,mail,'.$alumno->id."email:rfc,dns"]
        ]);



        $alumno->nombre=ucwords($request->nombre);
        $alumno->apellidos=ucwords($request->apellidos);
        $alumno->mail($request->mail);

        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            $file=$request->file('logo');
            $nom = 'logo/'.time().' . '.$file->getClientOriginalName();

            \Storage::disk('public')->put($nom, \File::get($file));

            $imagenOld = $alumno->logo;
            if(basename($imagenOld)!='default.jpg'){
                unlink($imagenOld);
            }
            $alumno->logo="img/$nom";

            }

        $alumno->update();
        return redirect()->route('alumnos.index')->with('mensaje','alumno guardado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //tener cuidado de borrar las imagenes salvo default.jpg
        $logo = $alumno->logo;
        if(basename($logo)!='default.jpg'){
            unlink($logo);
        }
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno Borrado');
    }
}
