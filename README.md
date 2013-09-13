# Fortissimo Commons

Common commands for the [Fortissimo
Framework](https://github.com/masterminds/fortissimo).

This project focuses on collecting common commands that are used within
Fortissimo applications.

## Usage

1. Include the library in your `composer.json` 
  file: `require: {'masterminds/fortissimo-commons': 'dev-master' }`
2. run `composer update` to use the library
3. Use the commands: `->does('\Fortissimo\Commons\Foo')`

For more on composer, see [GetComposer](http://getcomposer.com).

## Contribute to This Library!

We're looking for useful commands to add! Go ahead and fork the master
branch and add your commands. Then issue a pull request and we'll be in
touch!

There are a few basic caveats for what we're looking for.

Critieria for inclusion:

- Commands should be generalized.
- Commands should not require external libraries -- only Fortissimo
  and PHP itself. (Special cases will be considered, though.)
- Commands should be useful in a wide variety of cases.
- Commands should NOT require a datasource (including a database
  schema). But we are fine with file IO.

Examples that we'd like to include:

- Load a JSON file
- Perform date transformations
- Parse an XML file (with or without a schema)
- Save data to a file
- Generate a random string

Things we might consider bending the rules for:

- A Markdown converter
- A YAML reader

## Other Useful Fortissimo Libraries

- [Fortissimo-Twig](https://github.com/masterminds/fortissimo-twig):
  Twig template for Fortissimo.
- [Fortissimo-Base](https://github.com/masterminds/fortissimo-base):
  Scaffold an application quickly.

Got another useful Fortissimo library? Tell us about it and we'll add it to the
list.
