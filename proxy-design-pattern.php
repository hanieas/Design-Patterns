<?php

interface IRequest
{
    public function sendRequest(): void;
}

class Request implements IRequest
{
    public function sendRequest(): void
    {
        echo 'This request has been sent from request class.';
    }
}

class LoginUserAccess implements IRequest
{

    private $requester;

    public function __construct(Request $request)
    {
        $this->requester = $request;
    }

    private function checkAccess(): bool
    {
        echo "Proxy: Checking access before sending request\n";
        return true;
    }

    public function sendRequest(): void
    {
        if ($this->checkAccess()) {
            $this->requester->sendRequest();
        } else {
            echo "Yo don't have permission to send request\n";
        }
    }
}

function clientCode(IRequest $request)
{
    $result = $request->sendRequest();
}

$realSubject = new Request();
clientCode($realSubject);

echo "\n\n\n";

$proxy = new LoginUserAccess($realSubject);
clientCode($proxy);
