<?

  declare(strict_types=1);

  namespace Pion\Routing\Route;

  use Pion\Actions\ActionInterface;

  class MatchPathRoute extends RegexRoute
  {
    public function __construct(string $path, ActionInterface $action)
    {
      parent::__construct(
        $path,
        $action,
        '!^' . preg_quote($path, '!') . '$!'
      );
    }
  }