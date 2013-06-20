# MailingReport PHP [![Build Status](https://secure.travis-ci.org/mailingreport/mailingreport-php.png?branch=master)](http://travis-ci.org/mailingreport/mailingreport-php)

The official PHP client for the MailingReport API.
For more information, documentation, integration, plugins, ... about MailingReport API, please visit the sandbox:
http://developers.mailingreport.com/api/

# Installation

The recommended way to install MailingReport API is through composer:

``` json
{
    "require": {
        "mailingreport/mailingreport-php": "dev-master"
    }
}
```

## Unit Tests

To run unit tests, you'll need `cURL` and a set of dependencies you can install using Composer:

```
php composer.phar install
```

Once installed, just launch the following command:

```
phpunit
```

You're done.

## Quick start

### Creating a client and get your account informations
You can quickly use a web service client

``` php
use Mgrt\Api\Factory\ClientFactory;

$client = ClientFactory::create(array(
            'username' => 'my_username',
            'password' => 'my_password'
          ));

// Let's find the information in your account
$account = $client->getAccount()->getResult();

// or you can do the same, calling directly the `get()` method of the client.
$account = $client->get('/account')->getResult();
```

The client is using [Guzzle Adapter](http://guzzlephp.org/) as default http adapter.
We also provide a Curl Http Adapter. To use it, you have to add an extra parameter to the client factory:
``` php
$client = ClientFactory::create(array(
            'username' => 'my_username',
            'password' => 'my_password',
            'http_adapter' => new Mgrt\Api\HttpAdapter\CurlHttpAdapter(),
          ));
```
And of course, you can write yours extending the HttpAdapterInterface.


### Calling client methods and getting a response
The client's methods like `get()` or `getFoo()` are returning of Response object you can use to know:
- if request was successfull or not
- the response status (status code like 200, 201, ..., 404)
- the response content (json string)

All client methods are visible in [`MRApiClient`](https://github.com/mailingreport/mailingreport-php/blob/master/src/Mgrt/Api/Client/MRApiClient.php) class.
Here are a few examples:
``` php
$client->getAccount();
$client->getTemplate();
$client->getTemplates();
$client->getContacts();
$client->getContacts();
$client->getContactHistory();
$client->scheduleCampaign();
$client->getInvoices();
// ...
```

### Getting a formatted and usable result
If you call the `getResult()` method on the response method, you are obtaining a `Result` or a `ResultCollection` object.
These two kinds of objects are formatted and enhanced responses object.

The `getResult()` method returns a single or a collection of `Result` objects by default.
You can ask to return a multi-dimensional array instead of an array of objects by sending `true` as parameter like this:
``` php
// single result
$template = $client->getTemplate(1111)->getResult(true);

/*
array(1) {
  'template' =>
  array(5) {
    'id' =>
    int(11)
    'name' =>
    string(16) "Name of my template"
    'body' => "<html><body>My Body</body></html>"
    ....
*/


// Collection
$arr = $client->getTemplates()->getResult(true);
```

Returned Result objects lets you calling properties methods on them like:
``` php
$template->getName();
$template->getBody();
$template->getCreatedAt();
```

Note: Methods of Result objects are "MAGIC" and they are drawn form the camel case syntax of the resource return parameters.
[Watch the GET Template returns parameters, name in API doc (/templates/{templateId}).](http://developers.mailingreport.dev/mgrtappdev.php/api/)

#### Result collection
Result collection returns paginated list of results.
You can navigate through the whole list using dedicated methods
``` php
$collection = $client->getCampaigns(array(
    'status' =>'drafted',
    'sort' => 'createdAt',
    'direction' => 'desc'
))->getResult();

$collection->getPage(); // Will returns the current page number of results
$collection->getTotal(); // Will returns the total number of results
$collection->getLimit(); // Will returns the page range of results (example 100 per 100)
```

`ResultCollection` results are iterable so you can simply browse them:
``` php
foreach ($collection as $campaign) {
    echo $campaign->getSubject();
}
```

### Check the response status first

If the following find no response, it will return null as response:
``` php
$account = $client->get('account')->getResult();
// returns NULL
```

So you can check the response status before continuing:
``` php
$response = $client->get('/templates/123');
// or
$response = $client->getTemplate(123);

if ($response->isSuccessful()) {
    $template = $response->getResult();
    echo $template->getName();
} else {
    echo $response->getStatusCode().' Template was not found.';
}

```

## How to create a new contact
To create a new contact, see below:

``` php
$response = $client->createContact(array(
                'email' => 'foo@bar.com',
                'mailing_lists' => array(1)
            ));

if ($response->isSuccessful()) {
    $newContact = $response->getResult(); 

    echo "Your contact ".$newContact->getEmail()." has been created with id #".$newContact->getId();
}
```

## How to make a partial update

### Example 1: Update campaign name
For example, if you want to change the name of a given template, you can do this:

``` php
$response = $client->updateCampaign(9999, array('campaign' => array(
                'name' => 'A brand new name for my campaign'
                )));
if ($response->isSuccessful()) {
    echo "Your campaign has got an new name.";
}
```

### Example 1: Update some contact custom fields values
If you want to edit custom fields for a contact, you must do it like this:
``` php
$response = $client->updateContact(1111, array('contact' => array(
                'custom_fields' => array(
                    array(
                        'id'    => 3333, // Id of the custom field
                        'value' => 'New foo' // New value
                    ),
                    array(
                        'id' => 4444, 
                        'value' => 'New bar'
                    )
                )
            )));
if ($response->isSuccessful()) {
    echo "Some of your contact's custom fields have been updated.";
}
```

## How to delete a contact
To delete a contact, you have to do this:
``` php
$response = $client->deleteContact(99999);

if ($response->isSuccessful()) {
    echo "This contact has been deleted.";
}
```

## More informations
* [Mailing Report API resources documentation](http://developers.mailingreport.com/api/)
* [Guzzle PHP HTTP Client](http://guzzlephp.org/)

## Credits

* [Franck Schneider](https://github.com/franckschneider)
* [Remy Lemeunier](https://github.com/remyLemeunier)
* [Benjamin Laugueux](https://github.com/blaugueux)

Many thanks to [all other contributors](https://github.com/mailingreport/mgrt-php/contributors).

## License

This software is released under the MIT License. See the bundled LICENSE file for details.
