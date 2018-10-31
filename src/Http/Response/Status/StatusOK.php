<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Status;

  final class StatusOK implements StatusInterface
  {
    public function code(): int
    {
      return 200;
    }

    public function text(): string
    {
      return 'OK';
    }
  }