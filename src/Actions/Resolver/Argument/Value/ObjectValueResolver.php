<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver\Argument\Value;

  use Pion\Actions\Resolver\Argument\Metadata\ArgumentMetadataInterface;

  class ObjectValueResolver implements ValueResolverInterface
  {
    /**
     * @var object
     */
    private $origin;

    public function __construct($origin)
    {
      $this->origin = $origin;
    }

    public function isSupported(ArgumentMetadataInterface $metadata): bool
    {
      return $metadata->type()->isObject()
             && is_subclass_of($metadata->type()->name(), \get_class($this->origin));
    }

    /**
     * @return mixed
     */
    public function value(ArgumentMetadataInterface $metadata)
    {
      return $this->origin;
    }
  }