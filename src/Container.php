<?php
namespace Pyncer\Container;

use Closure;
use Pyncer\Container\Exception\NotFoundException;
use Pyncer\Container\Exception\ContainerException;
use Throwable;

use function array_key_exists;
use function call_user_func;
use function is_callable;

class Container implements ContainerInterface
{
    protected array $values = [];

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException($id);
        }

        if ($this->values[$id] instanceof Closure) {
            try {
                $this->values[$id] = call_user_func($this->values[$id]);
            } catch (Throwable $e) {
                throw new ContainerException('Error retrieving lazily generated value.');
            }
        }

        return $this->values[$id];
    }
    public function set(string $id, mixed $value): static
    {
        if ($value === null) {
            unset($this->values[$id]);
        } else {
            $this->values[$id] = $value;
        }

        return $this;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->values);
    }
}
