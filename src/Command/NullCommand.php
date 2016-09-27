<?php

namespace Eve\Command;

use Command\Command;
use Eve\Message;

/**
 * NullCommand
 */
final class NullCommand implements Command
{
    /**
     * @param Message $message
     *
     * @return bool
     */
    public function canHandle(Message $message): bool
    {
        return true;
    }

    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
        ; // Do what Matthew does all day
    }
}
