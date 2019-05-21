<?

  declare(strict_types=1);

  namespace Pion\Forms;

  use Pion\Forms\Handle\HandlingResultInterface;
  use Pion\Http\Request\Method\RequestMethodInterface;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Templating\Renderable\RenderableInterface;
  use Psr\Http\Message\UriInterface;

  interface FormInterface extends RenderableInterface
  {
    public function handle(ParametersInterface $parameters): HandlingResultInterface;

    public function action(): UriInterface;

    public function name(): string;

    public function method(): RequestMethodInterface;
  }