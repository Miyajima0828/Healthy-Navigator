<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

/**
 * 不正なリクエストに関するエラーが発生した際に利用する例外クラス
 */
class BadRequestException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = "",
        int $code = ResponseAlias::HTTP_BAD_REQUEST,
        Throwable $previous = null
    ) {
        $exceptionMessage = $message;
        parent::__construct($exceptionMessage, $code, $previous);
    }
}
