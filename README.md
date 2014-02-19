# MailingReport PHP SDK
[![Latest Stable Version](https://poser.pugx.org/mailingreport/mailingreport-php/version.png)](https://packagist.org/packages/mailingreport/mailingreport-php)
[![Build Status](https://travis-ci.org/mailingreport/mailingreport-php.png)](https://travis-ci.org/mailingreport/mailingreport-php)

The official PHP client for the MailingReport API.
For more information, documentation, integration, plugins, ... about MailingReport API, please visit the developers dedicated website:
[https://fr.mailingreport.com/api/](https://fr.mailingreport.com/api/)

# Installation

The recommended way to install MailingReport API is through composer:

``` json
{
    "require": {
        "mailingreport/mailingreport-php": "dev-master"
    }
}
```

# Usage
## Create an api client

You can find these credentials in your MailingReport account inside the "Settings" section then "Api keys".

``` php
$api = \Mgrt\Client::factory(array(
    'public_key' => 'your_public_key',
    'private_key' => 'your_private_key',
));
```

## Retrieving collection

When retrieving a collection you will get a ```ResultCollection``` class. You can get the current page, the limit and the total number of elements in the global collection.

``` php
$contacts = $api->getContacts();

$contacts->getPage(); // 1
$contacts->getLimit(); // 50
$contacts->getTotal(); // 250 for example
```

You can also set parameters when retrieving a collection.

``` php
$contacts = $contacts->getContacts(array(
    'page'      => 2,
    'limit'     => 10,
    'sort'      => 'createdAt',
    'direction' => 'asc',
));

$contacts->getPage(); // 2
$contacts->getLimit(); // 10
$contacts->getTotal(); // 250 for example
```

With the ResultCollection you can iterate over the collection.

``` php
foreach ($contacts as $contact) {
    echo $contact->getId(); // 1 for example
}
```

## Accounts

__Available API methods__
* ```$api->getAccount()``` will return a ```Account``` object.

__Available methods on ```Account``` object__
* ```$account->getId()``` will return an ```integer```.
* ```$account->getCompany()``` will return a ```string```.
* ```$account->getAddressStreet()``` will return a ```string```.
* ```$account->getAddressCity()``` will return a ```string```.
* ```$account->getAddressZipcode()``` will return a ```string```.
* ```$account->getAddressCountry()``` will return a ```string```.
* ```$account->getCurrency()``` will return a ```string```.
* ```$account->getTimezone()``` will return a ```string```.
* ```$account->getCredits()``` will return a ```integer```.
* ```$account->getPlanType()``` will return a ```string```.


## ApiKeys

__Available API methods__
* ```$api->getApiKeys()``` will return a ```ResultCollection ``` containing a collection of ```ApiKey```.
* ```$api->getApiKey()``` will return a ```ApiKey``` object.
* ```$api->createApiKey()``` will return a ```ApiKey``` object.
* ```$api->updateApiKey()``` will return a ```boolean```.
* ```$api->deleteApiKey()``` will return a ```boolean```.
* ```$api->disableApiKey()``` will return a ```boolean```.
* ```$api->enableApiKey()``` will return a ```boolean```.

__Available methods on ```ApiKeys``` object__
* ```$apiKey->getId()``` will return an ```integer```.
* ```$apiKey->getName()``` will return a ```string```.
* ```$apiKey->getPublicKey()``` will return a ```string```.
* ```$apiKey->getPrivateKey()``` will return a ```string```.
* ```$apiKey->getEnabled()``` will return a ```boolean```.
* ```$apiKey->getCreatedAt()``` will return a ```DateTime```.
* ```$apiKey->getDisabledAt()``` will return a ```DateTime```.


## Campaigns

__Available API methods__
* ```$api->getCampaigns()``` will return a ```ResultCollection ``` containing a collection of ```Campaign```.
* ```$api->getCampaign($contactId)``` will return a ```Contact``` object.
* ```$api->createCampaign($campaign)``` will return a ```Contact``` object.
* ```$api->updateCampaign($campaign)``` will return a ```boolean```.
* ```$api->deleteCampaign($campaign)``` will return a ```boolean```.
* ```$api->scheduleCampaign($campaign)``` will return a ```boolean```.
* ```$api->unscheduleCampaign($campaign)``` will return a ```boolean```.

__Available methods on ```Campaign``` object__
* ```$campaign->getId()``` will return an ```integer```.
* ```$campaign->getName()``` will return a ```string```.
* ```$campaign->getMailingLists()``` will return an array of ```MailingList``` objects.
* ```$campaign->getSubject()``` will return a ```string```.
* ```$campaign->getBody()``` will return a ```string```.
* ```$campaign->getFromMail()``` will return a ```string```.
* ```$campaign->getFromName()``` will return a ```string```.
* ```$campaign->getReplyMail()``` will return a ```string```.
* ```$campaign->getCreatedAt()``` will return a ```DateTime```.
* ```$campaign->getUpdatedAt()``` will return a ```DateTime```.
* ```$campaign->getScheduledAt()``` will return a ```DateTime```.
* ```$campaign->getSentAt()``` will return a ```DateTime```.
* ```$campaign->getTrackingEndsAt()``` will return a ```DateTime```.
* ```$campaign->getStatus()``` will return a ```string```.
* ```$campaign->getIsPublic()``` will return a ```boolean```.
* ```$campaign->getShareUrl()``` will return a ```string```.


## Contacts

__Available API methods__
* ```$api->getContacts()``` will return a ```ResultCollection ``` containing a collection of ```Contact```.
* ```$api->getContact($contactId)``` will return a ```Contact``` object.
* ```$api->getContact($contactEmail)``` will return a ```Contact``` object.
* ```$api->createContact($contact)``` will return a ```Contact``` object.
* ```$api->updateContact($contact)``` will return a ```boolean```.
* ```$api->deleteContact($contact)``` will return a ```boolean```.
* ```$api->unsubscribeContact($contact)``` will return a ```boolean```.
* ```$api->resubscribeContact($contact)``` will return a ```boolean```.

__Available methods on ```Contact``` object__
* ```$contact->getId()``` will return an ```integer```.
* ```$contact->getEmail()``` will return a ```string```.
* ```$contact->getMailingLists()``` will return an array of ```MailingList``` objects.
* ```$contact->getCustomFields()``` will return an array of ```CustomField``` objects.
* ```$contact->getLatitude()``` will return a ```string```.
* ```$contact->getLongitude()``` will return a ```string```.
* ```$contact->getCountryCode()``` will return a ```string```.
* ```$contact->getTimeZone()``` will return a ```string```.
* ```$contact->getCreatedAt()``` will return a ```DateTime```.
* ```$contact->getUpdatedAt()``` will return a ```DateTime```.


## Custom Fields

__Available API methods__
* ```$api->getCustomFields()``` will return a ```ResultCollection ``` containing a collection of ```CustomField```.

__Available methods on ```CustomField``` object__
* ```$customField->getId()``` will return an ```integer```.
* ```$customField->getName()``` will return a ```string```.
* ```$customField->getFieldType()``` will return a ```string```.
* ```$customField->getValue()``` will return a ```string```.
* ```$customField->getChoices()``` will return an array of ```string```.


## Domains

__Available API methods__
* ```$api->getDomains()``` will return a ```ResultCollection ``` containing a collection of ```Domain```.
* ```$api->getDomain($domainId)``` will return a ```Domain``` object.
* ```$api->checkDomain($domain)``` will return a ```Domain``` object.

__Available methods on ```Domain``` object__
* ```$domain->getId()``` will return an ```integer```.
* ```$domain->getName()``` will return a ```string```.
* ```$domain->getFieldType()``` will return a ```string```.
* ```$domain->getValue()``` will return a ```string```.
* ```$domain->getChoices()``` will return an array of ```string```.


## Invoices

__Available methods on ```Invoice``` object__
* ```$invoice->getId()``` will return an ```integer```.
* ```$invoice->getNumber()``` will return a ```string```.
* ```$invoice->getNetAmount()``` will return a ```float```.
* ```$invoice->getTaxAmount()``` will return a ```float```.
* ```$invoice->getTotalAmount()``` will return a ```float```.
* ```$invoice->getDueAt()``` will return a ```DateTime```.
* ```$invoice->getPaidAt()``` will return a ```DateTime```.
* ```$invoice->getInvoiceLines()``` will return an array of ```InvoiceLine``` objects.

__Available methods on ```InvoiceLine``` object__
* ```$invoiceLine->getId()``` will return an ```integer```.
* ```$invoiceLine->getTitle()``` will return a ```string```.
* ```$invoiceLine->getDescription()``` will return a ```string```.
* ```$invoiceLine->getQuantity()``` will return a ```float```.
* ```$invoiceLine->getPrice()``` will return a ```float```.

__Available API methods__
* ```$api->getInvoices()``` will return a ```ResultCollection ``` containing a collection of ```Invoice```.
* ```$api->getInvoice($invoiceId)``` will return a ```Invoice``` object.


## MailingLists

__Available methods on ```MailingList``` object__
* ```$mailingList->getId()``` will return an ```integer```.
* ```$mailingList->getName()``` will return a ```string```.
* ```$mailingList->getCreatedAt()``` will return a ```DateTime```.
* ```$mailingList->getUpdatedAt()``` will return a ```DateTime```.

__Available API methods__
* ```$api->getMailingLists()``` will return a ```ResultCollection ``` containing a collection of ```MailingList```.
* ```$api->getMailingList($mailingListId)``` will return a ```MailingList``` object.
* ```$api->createMailingList($mailingList)``` will return a ```MailingList``` object.
* ```$api->updateMailingList($mailingList)``` will return a ```boolean```.
* ```$api->deleteMailingList($mailingList)``` will return a ```boolean```.
* ```$api->getMailingListContacts($mailingList)``` will return a ```ResultCollection ``` containing a collection of ```Contact```.


## Senders

__Available methods on ```Sender``` object__
* ```$sender->getId()``` will return an ```integer```.
* ```$sender->getEmail()``` will return a ```string```.
* ```$sender->getEmailType()``` will return a ```string```.
* ```$sender->getIsEnabled()``` will return a ```boolean```.

__Available API methods__
* ```$api->getSenders()``` will return a ```ResultCollection ``` containing a collection of ```Sender```.
* ```$api->getSender($sender)``` will return a ```Sender``` object.
* ```$api->deleteSender($sender)``` will return a ```boolean```.


## Templates

__Available methods on ```Template``` object__
* ```$template->getId()``` will return an ```integer```.
* ```$template->getName()``` will return a ```string```.
* ```$template->getBody()``` will return a ```DateTime```.

__Available API methods__
* ```$api->getSenders()``` will return a ```ResultCollection ``` containing a collection of ```Template```.
* ```$api->getTemplate($template)``` will return a ```Template``` object.
* ```$api->deleteSender($template)``` will return a ```boolean```.


## Unit Tests

To run unit tests, you'll need a set of dependencies you can install using Composer

Once installed, just launch the following command:

```
phpunit
```

Rename the phpunit.xml.dist file to phpunit.xml, then uncomment the following lines and add your own API keys:

``` php
<php>
    <!-- <server name="PUBLIC_KEY" value="your_public_key" /> -->
    <!-- <server name="PRIVATE_KEY" value="your_private_key" /> -->
</php>
```
You're done.

## More informations
* [MailingReport API resources documentation](http://fr.mailingreport.com/api/)
* [Guzzle PHP HTTP Client](http://guzzlephp.org/)

## Credits

Many thanks to [all contributors](https://github.com/mailingreport/mailingreport-php/contributors).

## License

This software is released under the MIT License. See the bundled LICENSE file for details.
