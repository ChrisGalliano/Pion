<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver\Argument\Metadata\Type;

  class ReflectionTypeMetadata implements TypeMetadataInterface
  {
    /**
     * @var \ReflectionType
     */
    private $reflectionType;

    public function __construct(\ReflectionType $reflectionType)
    {
      $this->reflectionType = $reflectionType;
    }

    public function isBoolean(): bool
    {
      return $this->reflectionType->getName() === 'boolean';
    }

    public function isInt(): bool
    {
      return $this->reflectionType->getName() === 'int';
    }

    public function isFloat(): bool
    {
      return $this->reflectionType->getName() === 'float';
    }

    public function isString(): bool
    {
      return $this->reflectionType->getName() === 'string';
    }

    public function isArray(): bool
    {
      return $this->reflectionType->getName() === 'array';
    }

    public function isObject(): bool
    {
      return \is_object($this->reflectionType->getName());
    }

    public function name(): string
    {
      return $this->reflectionType->getName();
    }
  }