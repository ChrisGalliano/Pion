<?
  declare(strict_types=1);
  
  namespace Pion\Actions\Resolver\Argument\Metadata;
  
  use Pion\Actions\Resolver\Argument\Metadata\Exceptions\UnknownParameterTypeException;
  use Pion\Actions\Resolver\Argument\Metadata\Type\ReflectionTypeMetadata;
  use Pion\Actions\Resolver\Argument\Metadata\Type\TypeMetadataInterface;

  class ReflectionArgumentMetadata implements ArgumentMetadataInterface
  {
    /**
     * @var \Pion\Actions\Resolver\Argument\Metadata\Type\ReflectionTypeMetadata
     */
    private $reflectionTypeMetadata;
    
    /**
     * @var string
     */
    private $name;
  
    /**
     * @throws \Pion\Actions\Resolver\Argument\Metadata\Exceptions\UnknownParameterTypeException
     */
    public function __construct(\ReflectionParameter $reflectionParameter)
    {
      $type = $reflectionParameter->getType();
      if ($type === null) {
        throw new UnknownParameterTypeException($reflectionParameter->getName());
      }
      $this->reflectionTypeMetadata = new ReflectionTypeMetadata($type);
      $this->name = $reflectionParameter->getName();
    }
    
    public function type(): TypeMetadataInterface
    {
      return $this->reflectionTypeMetadata;
    }
    
    public function name(): string
    {
      return $this->name;
    }
  }