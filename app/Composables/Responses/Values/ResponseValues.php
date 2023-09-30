<?php

namespace App\Composables\Responses\Values;

use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use function Composer\Autoload\includeFile;

class ResponseValues
{
    public function __construct(
        public string|null $message = null,
        public bool        $isSuccessful = true,
        public mixed       $data = null,
        public mixed       $extra = null,
        public int         $statusCode = SymfonyResponse::HTTP_OK,
    )
    {
    }

    public function getBodySchema(): array
    {
        return [
            'status_code' => $this->statusCode,
            'message' => $this->message,
            'is_successful' => $this->isSuccessful,
            'data' => $this->data,
            'extra' => $this->extra
        ];
    }

    public function message(array|string $message): ResponseValues
    {
        $replace = [];
        if (is_array($message)) {
            $replace = $message[1] ?? [];
            // translate attributes if have any translated value
             foreach ($replace as $attr => $value) {
                 if (Lang::has('validation.attributes.' . $value)) {
                     $replace[$attr] = trans("validation.attributes." . $value);
                 }
            }

            $message = $message[0];
        }

        $this->message = __($message, $replace);

        return $this;
    }

    public function data(mixed $data): ResponseValues
    {
        $this->data = $data;

        return $this;
    }

    public function successful(): ResponseValues
    {
        $this->isSuccessful = true;

        return $this;
    }

    public function failed(): ResponseValues
    {
        $this->isSuccessful = false;

        return $this;
    }

    public function extra(mixed $extra): ResponseValues
    {
        $this->extra = $extra;

        return $this;
    }

    public function statusCode(int $statusCode): ResponseValues
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function jsonBody(): string|false
    {
        return json_encode($this->getBodySchema());
    }
}
