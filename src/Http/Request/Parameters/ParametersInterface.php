<?
  declare(strict_types=1);

  namespace Pion\Http\Request\Parameters;

  interface ParametersInterface
  {
    /**
     * @return mixed
     */
    public function require(string $key);

    public function has(string $key): bool;

    /**
     * @return mixed[]
     */
    public function all(): array;
  }