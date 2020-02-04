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

    public function __construct(object $origin)
    {
      $this->origin = $origin;
    }

    public function isSupported(ArgumentMetadataInterface $metadata): bool
    {
      return $metadata->type()->isObject()
             && (
               $metadata->type()->name() === \get_class($this->origin)
               || is_subclass_of(\get_class($this->origin), $metadata->type()->name())
             );
    }

    public function value(ArgumentMetadataInterface $metadata) : object
    {
      return $this->origin;
    }
  }