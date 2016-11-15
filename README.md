Veridu idOS PHP SDK for PHP5 (for PHP7 [Click Here](https://github.com/veridu/idos-sdk-php/tree/php7))
===================

Installation
------------

This SDK can be found on [Packagist](https://packagist.org/packages/veridu/veridu-php).

Is recommended to install this SDK by using [composer](http://getcomposer.org).

If you are using composer, please edit your `composer.json` and add the following:

```json
{
    "require": {
        "veridu/idos-sdk-php": "^0.1"
    }
}
```

To continue with the installation please add this dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Examples
--------

You can find examples of basic usage on the [samples/](samples) directory.

Bugs and feature requests
-------------------------

Found a Bug? Have a feature request? [Please open a new issue](https://github.com/veridu/idos-sdk-php/issues).

Before opening any issue, please search for existing issues and read the [Issue Guidelines](https://github.com/necolas/issue-guidelines), written by [Nicolas Gallagher](https://github.com/necolas/).

Versioning
----------

This SDK will be maintained under the Semantic Versioning guidelines as much as possible.

Releases will be numbered with the following format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

* Breaking backward compatibility bumps the major (and resets the minor and patch)
* New additions without breaking backward compatibility bumps the minor (and resets the patch)
* Bug fixes and misc changes bumps the patch

For more information on SemVer, please visit [http://semver.org/](http://semver.org/).

Tests
-----

To run the tests, you must install dependencies with `composer install --dev`.

How To Use The New SDK
----------------------

The majority of the endpoints require Authentication Tokens when making requests to the API.

There are three kinds of tokens: UserToken, CredentialToken or IdentityToken.

### First Step

The first step is to create an auth object passing through its constructor the credentials necessary for the request intended.

```php
/**
 * Instantiates an auth object of CredentialToken Class.
 * Foreach type of Authorization, there is a Class to be instantiated.
 */
$auth = new \idOS\Auth\CredentialToken(
	$credentials['credentialPublicKey'],
	$credentials['handlerPublicKey'],
	$credentials['handlerPrivKey']
);

```

### Second Step

The second step is to instantiate the SDK itself, calling the static method create

```php
$sdk = \idOS\SDK::create($auth);
```

### Third Step

The third step to perform is the requests to the endpoints.

At the time being we only support endpoints related to the users methods.

To simplify the SDK and its usage,every fragment of the request is separated in different classes.

```php
/**
 * Making a /GET request to scores endpoint, listing all scores.
 */
$response = $sdk
    ->Profile($credentials['username']) //passing the username in the Profile Class constructor
    ->Scores->listAll();

/**
 * Making a /POST request to gates endpoint, creating a new gate
 */
$response = $sdk
	->Profile($credentials['username']) //passing the username in the Profile Class constructor
	->Gates->createNew('18+', true);

```
To see more examples of how to use the SDK and how to call the methods and endpoints, go to the [samples/](samples) directory.
