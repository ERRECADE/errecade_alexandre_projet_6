<?php
namespace App\Helper;

class YoutubeHelper
{
    public static function getYouTubeVideoId($url)
    {
        if ($url !== null) {
            preg_match('/[\?\&]v=([^\?\&]+)/', $url, $matches);
            if (count($matches) > 0) {
                return $matches[1];
            }
        }

        return null;
    }
}