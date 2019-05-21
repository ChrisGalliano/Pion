<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements;

  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Templating\Engine\EngineInterface;

  interface FormElementInterface
  {
    public function name(): string;

    public function handle(ParametersInterface $parameters): ElementValidationResultsCollectionInterface;

    public function render(EngineInterface $engine): string;
  }