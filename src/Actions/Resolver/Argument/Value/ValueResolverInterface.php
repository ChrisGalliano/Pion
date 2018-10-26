<?
  declare(strict_types=1);
  
  namespace Pion\Actions\Resolver\Argument\Value;
  
  use Pion\Actions\Resolver\Argument\Metadata\ArgumentMetadataInterface;

  interface ValueResolverInterface
  {
    public function isSupported(ArgumentMetadataInterface $metadata): bool;
  
    /**
     * @return mixed
     */
    public function value(ArgumentMetadataInterface $metadata);
  }