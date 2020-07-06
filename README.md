## About Pion
Pion - легковесный PHP Framework.

## Pion Components
- [Pion Support](https://plugins.jetbrains.com/plugin/14599-pion-support) plugin for PhpStorm
- [Peony Templating](https://github.com/ChrisGalliano/PeonyTemplating)
- [Muon Forms](https://github.com/ChrisGalliano/MuonForms)


## Examples
- [Pion + Doctrine + Symfony Console + Docker](https://github.com/ChrisGalliano/PionExample)


## Pion principles
**1. Minimalism**<br/>
Pion предоставляет только базовый набор инструментов. Его задача -  получить пользовательский request, обработать его и вернуть ответ.<br/>
Такой подход проектирования использован умышленно, чтобы защитить ядро фреймворка от тесной интеграции c "лишними" компонентами. Вы без проблем можете использовать ваш любимый templating/ORM/IoC-container/etc. :smile:

> Ремарка 1: :arrow_right: [Pion Example](https://github.com/ChrisGalliano/PionExample), тут вы можете найти "plug and play" пример приложения построенного на связке Pion + Doctrine + Symfony Console + еще пара Symfony компонентов

> Ремарка 2: Для Pion разработан нативный templating компонент - [Peony](https://github.com/ChrisGalliano/PeonyTemplating) . Он супер простой и вряд ли подойдет вам для сложных задач. Но у него есть ряд преимуществ, например [PhpStorm плагин](https://plugins.jetbrains.com/plugin/14599-pion-support) для комплишна переданных во вьюшку переменных. :wink:

> Ремарка 3: Возможно в дальнейшем будут разработаны "нативные" ORM/IoC-container/Console/etc. компоненты. Но в любом случае они будут поставляться в виде отдельных пакетов.


**2. Customizability**<br/>
Pion спроектирован с расчетом на то, что практически любой из его внутренних компонентов может быть заменен кастомным.


**3. Muggle principle**<br/>
Архитектура фреймворка стремится к уменьшению количества "магии".
> ИМХО: вы должны иметь возможность в любой момент заглянуть "под капот" фреймворка и быстро понять, что там происходит. Без борьбы с "адом обратных вызов"/свалки из абстрактных классов и yaml/array конфигураций.<br/>

Pion продвигает идею очевидного flow и контролируемости.


**4. IoC**<br/>
Также Pion продвигает принципы инверсии управления. Это видно на примере использования подкомпонента Arguments Resolver (подробнее о нем ниже).
Вкратце - если какой-то экшн требует соединения с базой данных - приложение обязано передать ему экземпляр EntityManager в качестве аргумента.


**5. Foolproof**<br/>
Да, Pion предполагает, что вы каждый раз будете наследовать `\Pion\Http\Uri\PionUri` для определение ссылки для каждого экшена. Например. Но благодаря этому вы будете защищены от случайной опечатки в имени get параметра. Да и переименовывать get параметры будет значительно легче. :smile:


**6. Easy configuration**<br/>
Процесс конфигурации Pion очень прост (это же lightweight framework :slightly_smiling_face:). При конфигурации не используется yaml/json/ассоциативные массивы. Я глубоко убежден, что это плохая практика, так IDE не резолвит ключи в таких конфигурациях и если вам надо заглянуть "под капот" - приходится использовать текстовый поиск по названию этих ключей. :man_facepalming:

<ins>Вы должны иметь возможность в любой момент использовать "go to declaration" в любом месте конфигурации.</ins>



## Hello World
Пока в качестве Hello World - примера выступает репозиторий [Pion Example](https://github.com/ChrisGalliano/PionExample).
Можете скачать его себе и запустить пример на локали в Docker, там есть инструкция. На его примере достаточно легко понять принцип работы фреймворка.

А если вас интересуют детали - продолжайте прокручивать эту документацию :smiley:


##  Main Components
### Application
Application - сердце фреймворка. Его задачи:
- Определить action для текущего request-а
- Выполнить action и вернуть его результат

В качестве настроек Application принимает `\Pion\Routing\RoutingInterface` и `\Pion\Actions\Resolver\ActionArgumentsResolverInterface`.

Чтобы обработать request и получить ответ - необходимо вызвать метод `\Pion\Application\ApplicationInterface::dispatch` и передать ему экземпляр реализации `\Pion\Http\Request\RequestInterface`. Про эти компоненты ниже. :arrow_heading_down:

### Request
Любая реализация `\Pion\Http\Request\RequestInterface`. Стандартная реализация так и называется  - `\Pion\Http\Request\Request`. Предоставляет приложению более безопасный доступ к суперглобальным переменных `$_GET`/`$_POST`/`$_SERVER`/`$_COOKIES`.

### Routing
Любая реализация `\Pion\Routing\RoutingInterface`. Стандартная реализация - `\Pion\Routing\Routing`.
В качестве конфигурации принимает в конструкторе массив объектов, реализующих `\Pion\Routing\Route\RouteInterface`.

**RouteInterface**<br/>
У `\Pion\Routing\Route\RouteInterface` есть 3 метода:
- `\Pion\Routing\Route\RouteInterface::path(): string` - возвращает URL path роута. Нужен, чтобы построить URL для этого роута.
- `\Pion\Routing\Route\RouteInterface::isSupported(RequestInterface $request): bool` - определяет, может ли текущий роут обработать переданный request.
- `\Pion\Routing\Route\RouteInterface::action(): \Pion\Actions\ActionInterface` - возвращает объект экшена-обработчика этого роута.

### Actions
Согласно MVC в приложении должны быть контроллеры, которые получают пользовательский request, выполняют какую-то бизнес логику и возвращают ответ. Как правило в одном контроллере может находиться несколько экшенов, каждый из которых обрабатывает свой Route.
Этот подход плох по следующим причинам
- Классы контроллеров неконтролируемо разрастаются
- Экшены начинают использовать какую-то общую логику, инкапсулированную внутри контроллера. Когда такой экшн, по тем или иным причинам, нужно вынести в отдельный контроллер - это может стать проблемой.
- Если экшены хранят данные внутри свойств объекта контроллера - это может привести к неочевидным глюкам. Например экшн A помещает в `$this->user` объект авторизованного пользователя. А потом кто-то пытается реюзать `$this->user` в экшене B и получает NPE. Пример утрирован, но суть, думаю, ясна.

С оглядкой на все это в Pion нет контроллеров - есть Actions. Action реализует `\Pion\Actions\ActionInterface`.

Каждый экшн обязан реализовать 2 метода:
- `\Pion\Actions\ActionInterface::route(): \Pion\Routing\Route\RouteInterface` - возвращает Route настроенный для этого экшена.
- `\Pion\Actions\ActionInterface::__invoke(???): \Pion\Http\Response\ResponseInterface`. Метод `__invoke` не описан в `\Pion\Actions\ActionInterface`, так как может принимать произвольный набор параметров (об этом в блоке Argument resolving). По сути в этом методе мы обрабатываем запрос, выполняем бизнес-логику и возвращает ответ, который будет отправлен пользователю.


### Argument resolving
`\Pion\Actions\ActionInterface::__invoke(???)` - аргументы этого метода могут быть произвольными. В Pion используется механизм, называемый Argument resolving.
По сути он используется для IoC. Если ваш экшн зависит, например, от соединения с базой данных - его сигнатура должна выглядеть следующим образом:
```php
# ...
public function __invoke(DbConnection $dbConnection): \Pion\Http\Response\ResponseInterface {
  # ...
}
```

При инициализации этого экшена Application обязан передать ему DbConnection. Откуда Application получает эту зависимость?<br/>
Выше, в блоке `Application`, я писал, что один из элементов его конфигурации - это `\Pion\Actions\Resolver\ActionArgumentsResolverInterface`.<br/>
 Контракт этого интерфейса содержит всего 1 метод - `ActionArgumentsResolverInterface::resolve(ActionInterface $action): array`. Его задача проста - определить, какие аргументы нужно передать в метод `__invoke` и вернуть массив этих аргументов, если он может их определить.

Естественно логику определения аргументов не нужно реализовывать самому, для этого есть стандартная реализация - `\Pion\Actions\Resolver\ActionArgumentsResolver`.<br/>
В качестве настроек необходимо передать массив `\Pion\Actions\Resolver\Argument\Value\ValueResolverInterface`.<br/>
Не буду вдаваться в подробности, скажу вкратце - задача ValueResolver-а вернуть значение для какого-то одного конкретного аргумента в `__invoke`.

У `\Pion\Actions\Resolver\Argument\Value\ValueResolverInterface` конечно есть стандартные реализации, их две.

**ObjectValueResolver**<br/>
В качестве аргумента в конструкторе принимает объект, который будет резолвить.

**RequestValueResolver**<br/>
В качестве аргумента в конструкторе принимает RequestInterface. Умеет резолвить значения из $_GET и $_POST.



**Example:**

Допустим в вашем приложении есть экшн удаления пользователя. У этого экшена две зависимости - соединение с базой данных и ID пользователя, которого необходимо удалить.
```php
$request = new \Pion\Http\Request\Request();
$dbConnection = new DbConnection(...);
$response = (new \Pion\Application\Application(
  new \Pion\Routing\Routing(
    DeleteUserAction::route()
  ),
  new \Pion\Actions\Resolver\ActionArgumentsResolver(
    new \Pion\Actions\Resolver\Argument\Value\RequestValueResolver($request),
    new \Pion\Actions\Resolver\Argument\Value\ObjectValueResolver($dbConnection)
  )
))->dispatch($request);

# ...

class DeleteUserAction implements \Pion\Actions\ActionInterface {
  public function __invoke(DbConnection $dbConnection, string $userId) : \Pion\Http\Response\ResponseInterface {
    ...
  }
}
```

> P.S. Работать с `$_GET`/`$_POST` параметрами только через ArgumentsResolver не обязательно. Вы можете зарезолвить сам Request `new \Pion\Actions\Resolver\Argument\Value\ObjectValueResolver\ObjectValueResolver($request)` :smile:


### Response
> данный интерфейс находится в разработке и пока предоставляет базовый функционал.

Любая реализация `\Pion\Http\Response\ResponseInterface`. В качестве стандартной можно использовать `\Pion\Http\Response\PlainTextResponse` или `\Peony\Response\TemplatedResponse`, если вы используете [Peony](https://github.com/ChrisGalliano/PeonyTemplating).
Если вы используете другой темплейтинг - советую реализовать для него `TemplatedResponse` по [примеру](https://github.com/ChrisGalliano/PeonyTemplating/blob/master/src/Response/TemplatedResponse.php).


### URL's
Для построения URL на экшн предполагается наследовать `\Pion\Http\Uri\PionUri`.<br/>
Например [так](https://github.com/ChrisGalliano/PionExample/blob/master/web-app/src/HelloWorld/HelloWorldActionUri.php).