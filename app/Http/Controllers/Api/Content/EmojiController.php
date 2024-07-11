<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Services\EmojiService;
use Illuminate\Http\Request;
use JoyPixels\Ruleset;
use Overtrue\LaravelEmoji\Emoji;
use PHPHtmlParser\Dom;

class EmojiController extends Controller
{
    protected EmojiService $emojiService;

    public function __construct(EmojiService $emojiService)
    {
        $this->emojiService = $emojiService;
    }

    public function index(Request $request): array
    {
        return $this->emojiService->getAllEmojis();
    }
}
