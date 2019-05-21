<?
  declare(strict_types=1);

  namespace Pion\Forms\Layout;

  use Pion\Forms\FormInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Renderable\RenderableInterface;

  class FormLayout implements RenderableInterface
  {
    /**
     * @var FormInterface
     */
    private $form;

    public function __construct(FormInterface $form)
    {
      $this->form = $form;
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/FormLayoutView.html',
        [
          'form'   => $this->form,
          'engine' => $engine,
        ]
      );
    }
  }