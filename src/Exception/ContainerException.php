<?php
namespace Pyncer\Container\Exception;

use Psr\Container\ContainerExceptionInterface as PsrContainerExceptionInterface;
use Pyncer\Exception\Exception;
use Pyncer\Exception\RuntimeException;

class ContainerException extends RuntimeException implements
    Exception,
    PsrContainerExceptionInterface
{}
