<?

  declare(strict_types=1);

  namespace Pion\Routing\Route;

  class MatchPathRoute extends RegexRoute
  {
    public function __construct(string $path, string $actionClass)
    {
      parent::__construct(
        $path,
        $actionClass,
        '!^' . preg_quote($path, '!') . '$!'
      );
    }
  }