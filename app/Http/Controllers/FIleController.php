<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FIleController extends Controller
{
    //

    public function upload(Request $request)
    {
        $request->validate([
            'slama' => 'required|file',
        ]);

        $result = File::create([
            'files' => $request->file('slama')->store('apiDocs'),
        ]);

        if ($result) {
            return 'Upload Success';
        } else {
            return 'Upload Failed';
        }
    }


}
