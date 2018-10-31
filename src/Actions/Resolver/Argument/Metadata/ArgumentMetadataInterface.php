<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver\Argument\Metadata;

  use Pion\Actions\Resolver\Argument\Metadata\Type\TypeMetadataInterface;

  interface ArgumentMetadataInterface
  {
    public function type(): TypeMetadataInterface;

    public function name(): string;
  }