<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver\Argument\Metadata\Type;

  interface TypeMetadataInterface
  {
    public function isBoolean(): bool;

    public function isInt(): bool;

    public function isFloat(): bool;

    public function isString(): bool;

    public function isArray(): bool;

    public function isObject(): bool;

    public function name(): string;
  }