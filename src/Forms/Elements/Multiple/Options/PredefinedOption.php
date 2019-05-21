<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Multiple\Options;

  class PredefinedOption implements OptionInterface
  {
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $label;

    public function __construct(string $value, string $label = null)
    {
      $this->value = $value;
      $this->label = $label ?? $value;
    }

    public function value(): string
    {
      return $this->value;
    }

    public function label(): string
    {
      return $this->label;
    }
  }