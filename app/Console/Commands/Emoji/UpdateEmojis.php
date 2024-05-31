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
        $paste = [];
        foreach ($this->emojiService->getAllEmojis() as $shortName => $image) {
            $exploded = explode('_', $shortName);

            if (count($exploded) < 2) {
                $paste[] = [
                    'slug' => $shortName,
                    'image' => $image,
                ];
            }
        }

        \App\Models\Emoji::query()->insertOrIgnore($paste);
    }
}
