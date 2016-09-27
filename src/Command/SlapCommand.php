<?php

namespace Eve\Command;

use Eve\Message;
use Eve\SlackClient;

/**
 * SlapCommand
 */
final class SlapCommand implements Command
{
    /**
     * @var SlackClient
     */
    private $client;

    /**
     * Command constructor.
     *
     * @param SlackClient $client
     */
    public function __construct(SlackClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param Message $message
     *
     * @return bool
     */
    public function canHandle(Message $message): bool
    {
        return !$message->isDm() && preg_match('/slap .+/', $message->text());
    }

    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
        $receiver = $this->receiver($message);

        $content = '';
        if (preg_match('/^<@' . $this->client->userId() . '>$/', $receiver) || strtolower($receiver) === 'eve') {
            $receiver = "<@{$message->user()}>";

            $content = 'Nice try.' . "\n";
        }

        $content .= "_slaps {$receiver} around a bit with a large trout._";

        $this->client->sendMessage(
            $content,
            $message->channel()
        );
    }

    /**
     * @param Message $message
     *
     * @return string
     */
    private function receiver(Message $message): string
    {
        preg_match('/^[^ ]+ [^ ]+ ([^ ]+)/', $message->text(), $matches);

        return $matches[1];
    }
}
