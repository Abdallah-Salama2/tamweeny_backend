<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FIleController extends Controller
{
    //

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        //Storage::disk('public')->put('images', $request->file) ;

        $filePath = "images/" . time() . '.' . $request->file->getClientOriginalExtension();

        if (Storage::disk('public')->put($filePath,file_get_contents($request->file))){
        return $filePath;
        }

        //$url = Storage::disk('public')->url($user->file);

//        $result = File::create([
//            'files' => $request->file('slama')->store('apiDocs'),
//        ]);
//
//        if ($result) {
//            return 'Upload Success';
//        } else {
//            return 'Upload Failed';
//        }
    }


}
