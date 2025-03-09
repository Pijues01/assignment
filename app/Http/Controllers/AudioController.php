<?php

namespace App\Http\Controllers;

use App\Helpers\AudioHelper;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function getDuration(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'audio' => 'required|file|mimes:mp3,wav,ogg',
        ]);

        $audioFile = $request->file('audio');
        $filePath = $audioFile->store('audio_files', 'public'); // Store in storage/app/public/audio_files

        $duration = AudioHelper::getAudioDuration('storage/' . $filePath);

        return response()->json(['duration' => $duration]);
        // $audioFile = $request->file('audio');
        // $fileName = $audioFile->getClientOriginalName();
        // return response()->json([
        //     'filename' => $fileName,
        //     'duration' => $duration
        // ]);
    }
}
