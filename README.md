[![Code Climate](https://codeclimate.com/github/felixarntz/boilerplate/badges/gpa.svg)](https://codeclimate.com/github/felixarntz/boilerplate)
[![Latest Stable Version](https://poser.pugx.org/felixarntz/boilerplate/version)](https://packagist.org/packages/felixarntz/boilerplate)
[![License](https://poser.pugx.org/felixarntz/boilerplate/license)](https://packagist.org/packages/felixarntz/boilerplate)

# Boilerplate

Boilerplate for new libraries, WordPress plugins or themes.

## Requirements

* PHP >= 7.0

## Usage

Simply create a new project via Composer, using this repository as a foundation:

```BASH
composer create-project felixarntz/boilerplate <package-folder>
```

You will be asked questions about the type of the project and several parameters. Provide responses and follow the instructions to get your project set up within a minute.

You will be asked for the following project properties:

* Vendor name
* Package name
* Package description
* Package keywords
* Package VCS URL
* Package URL
* Author name
* Author email
* Author URL
* Package type (library|plugin)
* Minimum PHP version
* Minimum WordPress version
* Code standard
* Setup code standards?
* Setup quality assurance?
* Setup unit tests?
* Setup integration tests?
* Integrate with CodeClimate?
* Integrate with Travis-CI?
* Prepare for Packagist?
* Prepare for wordpress.org?
* WordPress.org contributors

Some of these questions will only be asked based on the responses you gave to prior questions. For example, WordPress-related details are only requested if you provided a package type of "plugin" or "theme".

### Disclaimer

* Support for themes is partly available already, however it will only be added as a configuration option once it has been finalized.
* Note that PHP 5.2 support at this time is limited. For example, the generated test PHP files require PHP 5.3. Support for PHP 5.2 may be added in the future - pull-requests welcome of course!
