<?php

interface Notification
{
    public function send(string $title, string $message);
}

class EmailNotification implements Notification
{

    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function send(string $title, string $message)
    {
        echo "Sent email with title '$title' to '{$this->email}' that says '$message'.";
    }
}

class SlackApi
{
    private $login;
    private $apiKey;

    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    public function logIn(): void
    {
        echo "Logged in to a slack account '{$this->login}'.\n";
    }

    public function sendMessage(string $chatId, string $message): void
    {
        echo "Posted following message into the '$chatId' chat: '$message'.\n";
    }
}

class SlackNotification implements Notification
{
    private $slack;
    private $chatId;

    public function __construct(SlackApi $slack, string $chatId)
    {
        $this->slack = $slack;
        $this->chatId = $chatId;
    }

    public function send(string $title,string $message)
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);
        $this->slack->logIn();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}

function clientCode(Notification $notification)
{
    $notification->send('Test','Test');
}

$slackApi = new SlackApi('Hanie','1234');
$notification = new SlackNotification($slackApi,'1');;
clientCode($notification);
