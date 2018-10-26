<?
  declare(strict_types=1);
  
  namespace Pion\Http\Request\Parameters;
  
  final class Parameters implements ParametersInterface
  {
    /**
     * @var mixed[]
     */
    private $parameters;
  
    /**
     * @param mixed[]
     */
    public function __construct(array $parameters) {
      $this->parameters = $parameters;
    }
  
    /**
     * @throws \Pion\Http\Request\Parameters\UndefinedParameterException
     */
    public function require(string $key)
    {
      if (!$this->has($key)) {
        throw new UndefinedParameterException($key);
      }
      return $this->parameters[$key];
    }
    
    public function has(string $key): bool
    {
      return array_key_exists($key, $this->parameters);
    }
    
    public function all(): array
    {
      return $this->parameters;
    }
  }