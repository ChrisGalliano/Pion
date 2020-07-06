## About Pion
Pion is a lightweight PHP Framework.


### Pion principles
**1. Minimalism**<br/>
Pion provides only the basic set of tools that allow you to receive a user request, process it and return a response.<br/>
With this approach, you are free to use your favorite templating/ORM/IoC-container etc. Pion is designed so as not to interfere with the integration of third-party components.

> Remark 1: Here you can find a "plug and play" example application built using Pion + Doctrine + Symfony Console

> Remark 2: For the Pion was created a native templating component - Peony. It is supplied separately in order to avoid tight integration with the core of the framework.

> Remark 3: Perhaps in the future their own ORM/IoC-container/Console/etc. components will be created, but in any case they will be delivered in separate packages.


**2. Customizability**<br/>
Pion is designed so that almost any of its components can be replaced with a custom one.

**3. Muggle principle**<br/>
The architecture of the framework is designed to reduce the amount of magic.
> Author's opinion: you should always be able to see what is happening "under the hood", without fighting the "callback hell"/dump of abstract classes and yaml configurations.<br/>

Pion pushes the obvious flow and controllability.

**4. IoC**<br/>
Pion also pushes to follow the principles of IoC. You can see this in the example of argument resolving in the [PionExample](). If some action requires a db connection, the application supplies it with an EntityManager instance as an input parameter.

**5. Foolproof**<br/>
Yes, peony forces you to implement an URI class for each action each time. For example. But thanks to this, you are safe from accidental typos in the get parameter name.<br/>
In addition, you can easily rename some get parameter without affecting all the places where an URI is created for the desired controller.


**6. Easy configuration**<br/>
The Pion configuration process is extremely simple. No need to use yaml/json/associative arrays. Because you should be able to use "go to declaration" at any time.