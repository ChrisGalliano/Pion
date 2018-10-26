<?
  declare(strict_types=1);
  
  namespace Pion\Actions\Resolver\Argument\Value;
  
  use Pion\Actions\Resolver\Argument\Metadata\ArgumentMetadataInterface;
  use Pion\Http\Request\Method\RequestMethodInterface;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Http\Request\RequestInterface;

  class RequestValueResolver implements ValueResolverInterface
  {
    /**
     * @var \Pion\Http\Request\RequestInterface
     */
    private $request;
    
    public function __construct(RequestInterface $request)
    {
      $this->request = $request;
    }
    
    public function isSupported(ArgumentMetadataInterface $metadata): bool
    {
      $isSupported = false;
      if (!$metadata->type()->isObject()) {
        $isSupported = $this->request->get()->has($metadata->name());
        if (!$isSupported && $this->request->method()->type() === RequestMethodInterface::POST) {
          $isSupported = $this->request->post()->has($metadata->name());
        }
      }
      return $isSupported;
    }
    
    public function value(ArgumentMetadataInterface $metadata)
    {
      $value = $this->getValue($metadata, $this->request->get());
      if ($value !== null && $this->request->method()->type() === RequestMethodInterface::POST) {
        $value = $this->getValue($metadata, $this->request->post());
      }
      return $value;
    }
    
    private function getValue(ArgumentMetadataInterface $metadata, ParametersInterface $parameters)
    {
      $value = null;
      if ($parameters->has($metadata->name())) {
        $value = $parameters->require($metadata->name());
        if ($metadata->type()->isArray()) {
          $value = (array) $value;
        } else if ($metadata->type()->isBoolean()) {
          $value = (bool) $value;
        } else if ($metadata->type()->isFloat()) {
          $value = (float) $value;
        } else if ($metadata->type()->isInt()) {
          $value = (int) $value;
        }
      }
      return $value;
    }
  }