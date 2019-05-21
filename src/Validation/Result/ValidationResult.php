<?
  declare(strict_types=1);

  namespace Pion\Validation\Result;

  class ValidationResult implements ValidationResultInterface
  {
    /**
     * @var string[]
     */
    private $errors;

    public function __construct(string... $errors) {
      $this->errors = $errors;
    }

    public function isValid(): bool
    {
      return \count($this->errors()) > 0;
    }

    public  function addError(string $error) : self {
    $this->errors[] = $error;
    return $this;
    }

    /**
     * @return string[]
     */
    public function errors(): array
    {
      return $this->errors;
    }
  }