<?php
namespace App\Helpers;

use getID3;

class AudioHelper
{
    public static function getAudioDuration($filePath)
    {
        $getID3 = new getID3;
        $fileInfo = $getID3->analyze(public_path($filePath));

        if (isset($fileInfo['playtime_seconds'])) {
            return gmdate("H:i:s", $fileInfo['playtime_seconds']);
        }

        return "Unknown duration";
    }
}

