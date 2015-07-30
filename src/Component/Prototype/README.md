Prototype Component
===================

The DAG Framework Prototype component is used to allow the extension of DAG resources into individual units. For instance, you could create a resource called Automobile, add the Prototype functionality to it, and be able to create instances car and motorcycle; each with different fields from the Field component.

Testing
-------
The DAG Framework uses [Codeception](http://codeception.com/) for its testing.

### Setup

```bash
composer install
```

### Run all test suites
```bash
bin/codecept run
```

Additionally, you may choose to run code coverage reports a la PHPUnit by adding the `--coverage` or `--coverage-html` flags.

Read more about testing in [the component testing documentation](#).

