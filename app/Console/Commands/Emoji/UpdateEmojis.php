<?php

namespace App\Console\Commands\Emoji;

use App\Services\EmojiService;
use Illuminate\Console\Command;
use JoyPixels\Ruleset;
use Overtrue\LaravelEmoji\Emoji;
use PHPHtmlParser\Dom;

class UpdateEmojis extends Command
{
    protected EmojiService $emojiService;

    public function __construct(EmojiService $emojiService)
    {
        parent::__construct();
        $this->emojiService = $emojiService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emojis:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emojis update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emojis = ['heart', 'like', 'dislike', 'smile', 'ok', 'wow', 'fire', 'love', 'star', 'happy', 'laugh', 'scientist', 'clown', 'embarrassed',
                    'cry', 'angry', 'happiness', 'shock', 'brain_explosion', 'suspicion', 'cool'];
        $paste = [];


        foreach ($emojis as $emoji) {
            $paste[] = [
                'slug' => $emoji,
                'image' => $emoji . '.png',
            ];
        }

        \App\Models\Emoji::query()->insert($paste);
    }
}
