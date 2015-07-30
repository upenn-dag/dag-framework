Resource Component
==================

The DAG Framework Resource component provides the foundation for all DAG resources. It provides a common, predictable API; as well as API's and code to support functionality that may be common to various DAG resources.

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

