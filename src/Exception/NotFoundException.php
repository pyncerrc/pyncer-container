<?php
namespace Pyncer\Container\Exception;

use Psr\Container\NotFoundExceptionInterface as PsrNotFoundExceptionInterface;
use Pyncer\Exception\Exception;
use Pyncer\Exception\RuntimeException;
use Throwable;

class NotFoundException extends RuntimeException implements
    Exception,
    PsrNotFoundExceptionInterface
{
    protected string $id;

    public function __construct(
        string $id,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        $this->id = $id;

        parent::__construct(
            'The specified identifier, ' . $id . ', was not associated with any entries.',
            $code,
            $previous
        );
    }

    public function getId(): string
    {
        return $this->id;
    }
}
