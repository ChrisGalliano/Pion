<?
  declare(strict_types=1);

  namespace Pion\Templating\Assets\Resource;

  interface ResourceInterface
  {
    public function render(): string;
  }