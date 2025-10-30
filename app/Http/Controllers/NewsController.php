<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\File;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $news = News::
        Title($request->get('data'))
        ->State($request->get('state'))
        ->Profile($request->get('profile'))
        ->paginate(10);

        $states = ['Activa','Inactiva'];
        $profiles = ['Estudiante','Docente','Egresado'];
        return view('news.index', compact('news', 'states', 'profiles'))
        ->with('i', ($request->input('page', 1) - 1) * 10);
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
        //
        //Validate data
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'expiration_date' => 'required',
        ]);

        $result = DB::transaction(function () use($request) {
            $new = new News();
            $new->title = $request->title;
            $new->subtitle = ($request->subtitle) ? $request->subtitle : '';
            $new->description = $request->description;
            $new->expiration_date = $request->expiration_date;
            $new->state = 1;
            $new->profile = ($request->profile) ? $request->profile : '';
            $new->link = ($request->link) ? $request->link : '';
            
            if(!$new->save()){
                return ['danger', 'Error, Al crear la noticia'];
            }
            
            if($request->file('imagenes')){
                foreach($request->file('imagenes') as $index => $imagen){

                    // Declaramos la ruta base
                    $directory = 'news/'.date('d-m-Y').'/images';
                    
                    // Creamos el directorio si no existe
                    if(!file_exists(storage_path('app/public/'.$directory))){
                        mkdir(storage_path('app/public/'.$directory), 0755, true);
                    }

                    // Tipo de archivo
                    $extension = strtolower($imagen->getClientOriginalExtension());

                    // Nombre del archivo (puedes hacerlo dinámico para que no se sobrescriban)
                    $name = 'imagen_'.$index.'_'.time();

                    // Ruta del archivo
                    $route_file = $directory.'/'.$name.'.'.$extension;

                    // Guardamos el archivo
                    Storage::disk('public')->put($route_file, \File::get($imagen));

                    // Verificamos si se guardó
                    if (Storage::disk('public')->exists($route_file)) {
                        $file = new File();
                        $file->new_id = $new->id;
                        $file->file_route = $route_file;
                        $file->save();
                    }

                }
            }

            return ['success', 'Noticia creada correctamente'];

        });
   
        return redirect()->route('news.index')
        ->with($result[0], $result[1]);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //Files the news
        $news->files = $news->files;
        return response()->json(array('news' => $news));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        ////Files the news
        $news->files = $news->files;
        return response()->json(array('news' => $news));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {  
        // Validar datos
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'expiration_date' => 'required',
        ]);

        $result = DB::transaction(function () use ($request, $news) {

            // Buscar la noticia
            $new = $news;

            // Actualizar campos
            $new->title = $request->title;
            $new->subtitle = $request->subtitle ?? '';
            $new->description = $request->description;
            $new->expiration_date = $request->expiration_date;
            $new->profile = $request->profile ?? '';
            $new->link = $request->link ?? '';

            if (!$new->save()) {
                return ['danger', 'Error al actualizar la noticia'];
            }

            // Si vienen nuevas imágenes, eliminar las anteriores y guardar las nuevas
            if ($request->hasFile('imagenes')) {

                //Remove the files of the news
                foreach($new->files as $file){
                    Storage::disk('public')->delete($file->file_route);
                    $file->delete();
                }
                //Remove the files of the news
                $new->files()->delete();

                // 🔹 Guardar las nuevas imágenes
                foreach ($request->file('imagenes') as $index => $imagen) {

                    // Directorio base
                    $directory = 'news/' . date('d-m-Y') . '/images';

                    // Crear directorio si no existe
                    if (!file_exists(storage_path('app/public/' . $directory))) {
                        mkdir(storage_path('app/public/' . $directory), 0755, true);
                    }

                    // Tipo de archivo
                    $extension = strtolower($imagen->getClientOriginalExtension());

                    // Nombre único del archivo
                    $name = 'imagen_' . $index . '_' . time();

                    // Ruta final
                    $route_file = $directory . '/' . $name . '.' . $extension;

                    // Guardar el archivo
                    Storage::disk('public')->put($route_file, \File::get($imagen));

                    // Verificar y registrar en BD
                    if (Storage::disk('public')->exists($route_file)) {
                        $file = new File();
                        $file->new_id = $new->id;
                        $file->file_route = $route_file;
                        $file->save();
                    }
                }
            }

            return ['success', 'Noticia actualizada correctamente'];
        });

        return redirect()
            ->back()
            ->with($result[0], $result[1]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //Remove the files of the news
        foreach($news->files as $file){
            Storage::disk('public')->delete($file->file_route);
            $file->delete();
        }
        //Remove the comments of the news
        $news->comments()->delete();
        //Remove the news
        $news->delete();
        return redirect()->route('news.index')
        ->with('success', 'Noticia eliminada correctamente');

    }
}
