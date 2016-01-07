README
======

What is The DAG Framework
-------------------------

Simply put, it is a set of components that join to create the basis of an application framework. I think, however, the answer is much bigger than that:

By itself, it is not runnable or executable; instead, it provides a foundation on which to build. Building your application around this framework allows you to receive a lot of common functionality at no cost, just because you followed the conventions the framework has set for you.

With a minimal set of assumptions, it provides the flexibility to set your own domain, environment, development style, and ui on yop of a powerful set of tools.

This framework assumes that you develop with (Symfony)[http://symfony.com/], using (Doctrine)[http://doctrine-project.org/], but is not limited to that technology stack. Each component is made up of two parts; the component and the bundle. The component is modular, and reusable. The bundle is the Symfony specific implementation in use by the DAG. There is no mandate requiring you to use the bundle in place of creating your own wrapper around each component.

The DAG Framework borrows HEAVILY from the Sylius E-Commerce project in its architecture. Having borrowed and adapted much of the Resource code from that library, we've included links and the LICENSE from that project in this library. A gigantic thanks goes out to those guys, and much appreciation for all of their hard work and ingenuity.

That's a high-level overview. To learn more, we invite you to (read the docs)[#].

Core Components
---------------

The following components are used in tandem to create a DAG Framework application. Each component may operate as an independent unit should you wish to have a more lean application stack.

- Resource
- Prototype
- Field
- Option
- Setting (only available as a bundle)

Requirements
------------

The DAG Components are only supported on PHP 5.4.0 and up. In addition, all requirements of Symfony 2.8 and up are also required if you wish to use the available bundles.

Installation
------------

Using The DAG Framework components is simple.

```bash
composer require dag/framework ~1.0
```

If you wish to enable the bundles for use within your Symfony application, you must [install them](http://symfony.com/doc/current/cookbook/bundles/installation.html) in `AppKernel.php` by including the following lines:

```php
// ...
class AppKernel extends Kernel
{
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new \DAG\Bundle\ResourceBundle\DAGResourceBundle(),
            new \DAG\Bundle\OptionBundle\DAGOptionBundle(),
            new \DAG\Bundle\FieldBundle\DAGFieldBundle(),
            new \DAG\Bundle\PrototypeBundle\DAGPrototypeBundle(),
        );
        // ...
    }
}
```

Testing
-------
The DAG Framework uses [Codeception](http://codeception.com/) for its testing. For convenience, a test runner has been added to this repository in order to run all subsequent test within the Framework. The framework, itself, is not tested at this time.

### Setup

```bash
composer install
```

### Run all test suites
```bash
bin/codecept run
```

### Run specific component test suite
```bash
bin/codecept run -c src/Component/[component-name]
```

Additionally, you may choose to run code coverage reports a la PHPUnit by adding the `--coverage` or `--coverage-html` flags.

Read more about testing in [the testing documentation](#).
