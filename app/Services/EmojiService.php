<?php

namespace App\Services;

use JoyPixels\Ruleset;
use Overtrue\LaravelEmoji\Emoji;
use PHPHtmlParser\Dom;

class EmojiService
{
    public function getAllEmojis()
    {
        $ruleset = app(Ruleset::class);
        $emojis = $ruleset->getShortcodeReplace();

        $return = [];

        foreach ($emojis as $key => $value) {
            $dom = new Dom;
            $dom->loadStr(Emoji::shortnameToImage($key));
            $a = $dom->find('img')[0];

            if ($a) {
                $return[$key] = $a->getAttribute('src');
            } else {
                continue;
            }
        }

        return $return;
    }
}
