<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Status;

  class PredefinedStatus implements StatusInterface
  {
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $text;

    public function __construct(int $code, string $text) {
      $this->code = $code;
      $this->text = $text;
    }

    public function code(): int
    {
      return $this->code;
    }

    public function text(): string
    {
      return $this->text;
    }
  }