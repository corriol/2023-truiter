<?php

namespace App\Helpers\Exceptions;

use Throwable;

class InvalidTypeUploadedFileException extends UploadedFileException
{
  public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
  {
      parent::__construct($message, $code, $previous);
  }
}