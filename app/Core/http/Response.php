<?php

class Response
{
    // private $content;
    // private $status;
    private $statusText;

    // private $headers;

    protected static array $statusTexts = [
        200 => "All OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Not-Authoritative Information",
        204 => "No Content",
        303 => "Moved Permanently",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        500 => "Internal Server Error"
    ];

    // public function __construct($body, $status = 200, $headers = []) {
    //     $this->content =$body;
    //     $this->status = $status;
    //     $this->statusText = self::$statusTexts[$status] ?? "Unknown status";
    //     $this->headers = $headers;
    // }

    public function __construct(private string $content, private int $status = 200, private array $headers = []) {
        $this->content = $content;      
        $this->status = $status;
        $this->statusText = self::$statusTexts[$status] ?? "Unknown status";
        $this->headers = $headers;
    }

    public function getContent() {
        return $this->content;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getStatusText() {
        return $this->statusText;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function send() {
        $httpLine = sprintf('HTTP/%s %s %s', '1.1', $this->getStatus(), $this->getstatusText());

        if (!headers_sent()) {
            header($httpLine, true, $this->getStatus());
            foreach ($this->getHeaders() as $name => $value) {
                header("$name:$value", false);
            }
        }
        echo $this->getContent();
    }

}