<?php

namespace App\Twig;

use App\Helper\YoutubeHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class YouTubeExtension extends AbstractExtension
{
    private $youtubeHelper;

    public function __construct(YoutubeHelper $youtubeHelper)
    {
        $this->youtubeHelper = $youtubeHelper;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getYouTubeVideoId', [$this, 'getYouTubeVideoId']),
        ];
    }

    public function getYouTubeVideoId($url)
    {
        return $this->youtubeHelper->getYouTubeVideoId($url);
    }
}
