<?
  declare(strict_types=1);

  namespace Pion\Templating\Assets\Manager;

  use Pion\Templating\Assets\Manager\Exceptions\UndefinedSectionException;
  use Pion\Templating\Assets\Resource\ResourceInterface;

  final class AssetsManager implements AssetsManagerInterface
  {
    /** @var \Pion\Http\Response\ResponseInterface[][] */
    private $sections = [];

    public function add(ResourceInterface $resource, string $section): AssetsManagerInterface
    {
      $this->sections[$section][] = $resource;
      return $this;
    }

    /**
     * @throws \Pion\Templating\Assets\Manager\Exceptions\UndefinedSectionException
     */
    public function render(string $section = null): void
    {
      if ($section !== null) {
        if (!array_key_exists($section, $this->sections)) {
          throw new UndefinedSectionException($section);
        }
        $resources = $this->sections[$section];
        unset($this->sections[$section]);
      } else {
        $resources = [];
        foreach ($this->sections as $sectionResources) {
          $resources = array_merge($resources, $sectionResources);
        }
        $this->sections = [];
      }

      $renderedResources = [];
      foreach ($resources as $resource) {
        $rendered = $resource->render();
        $renderedResources[$rendered] = $rendered;
      }
      foreach ($renderedResources as $resource) {
        print $resource;
      }
    }
  }
