<?php

namespace App\Http\Controllers;
use App\Http\Requests\UploadRequest;
use App\Photo;
use App\Section;
use Illuminate\Http\Request;
use File;
use Storage;

class PhotoController extends Controller
{     


    public function __construct() {
        $this->middleware(['auth', 'admin']);
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.photos.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request)
    {
        
        foreach ($request->photos as $photo) {
            $filename = time().md5($photo->getClientOriginalName()).'.'.$photo->getClientOriginalExtension();
            $directory = Section::$folder.'/'.request('section_id');
            Storage::disk('local')->putFileAs($directory, $photo, $filename);
            Photo::create([
                    'section_id' => request('section_id'),
                    'description' => request('description'),
                    'filename' => $filename,
                    'directory' => $directory
                ]);
            if (substr(File::mimeType($photo), 0, 5) == 'image') {                
                // $this->generateThumbs(file_get_contents($photo), $directory, $filename, 160, 840, 600);
                $webPhoto = \Image::make($photo);
                $webPhoto->resize(1600, 900, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $webPhoto = $webPhoto->encode('jpg');

                $thumb = \Image::make($photo)->fit(240, null, null, 'top')->encode('jpg');

                Storage::put($directory.'/web_'.$filename, $webPhoto->__toString());
                Storage::put($directory.'/thumb_'.$filename, $thumb->__toString());
            }
        }

        return redirect()->route('photos.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $sections = Section::all();
        return view('admin.photos.edit', compact('photo', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->validate(request(), [
                'section_id' => 'required',                
            ]);

        $photo->section_id = request('section_id');
        $photo->description = request('description');

        $photo->save();

        return redirect()->route('photos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        Storage::delete($photo->directory.'/'.$photo->filename);
        Storage::delete($photo->directory.'/web_'.$photo->filename);
        Storage::delete($photo->directory.'/thumb_'.$photo->filename);
        $photo->delete();

        return redirect()->route('photos.index');
    }
}
