<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Stream;

  final class Stream implements StreamInterface
  {
    /**
     * @var string
     */
    private $content;

    public function __construct(string $content)
    {
      $this->content = $content;
    }

    public function body(): string
    {
      return $this->content;
    }
  }