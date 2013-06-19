<?php

namespace Mgrt\Api\Client;

use Mgrt\Api\Response\Response;
use Mgrt\Api\Client\Client;

/**
 * Mgrt BaseClient
 */
class MRApiClient extends Client
{
    /**
     * Get account information
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getAccount()
    {
        return $this->get('account');
    }

    /**
     * Get custom fields
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getCustomFields()
    {
        return $this->get('customFields');
    }

    /**
     * Get api key
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getApiKey($id)
    {
        return $this->get(sprintf('apiKeys/%s', $id));
    }

    /**
     * Get a list of api keys
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getApiKeys(array $parameters = null)
    {
        return $this->get('apiKeys', $parameters);
    }

    /**
     * Enable the api key
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function enableApiKey($id)
    {
        return $this->put(sprintf('apiKeys/%s/enable', $id));
    }

    /**
     * Disable the api key
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function disableApiKey($id)
    {
        return $this->put(sprintf('apiKeys/%s/disable', $id));
    }

    /**
     * Get a single campaign
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getCampaign($id)
    {
        return $this->get(sprintf('campaigns/%s', $id));
    }

    /**
     * Get the campaign summary
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getCampaignSummary($id)
    {
        return $this->get(sprintf('campaigns/%s/summary', $id));
    }

    /**
     * Get a collection of campaigns
     *
     * @param array $parameters Default is null
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getCampaigns(array $parameters = null)
    {
        return $this->get('campaigns', $parameters);
    }

    /**
     * Create a new campaign
     *
     * @param array $parameters
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function createCampaign(array $parameters)
    {
        return $this->post('campaigns', $parameters);
    }

    /**
     * Replace the campaign
     *
     * @param integer $ids
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function replaceCampaign($id, array $parameters)
    {
        return $this->put(sprintf('campaigns/%s', $id), $parameters);
    }

    /**
     * Update the campaign
     *
     * @param integer $id
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function updateCampaign($id, array $parameters)
    {
        return $this->patch(sprintf('campaigns/%s', $id), $parameters);
    }

    /**
     * Remove the campaign
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function removeCampaign($id)
    {
        return $this->delete(sprintf('campaigns/%s', $id));
    }

    /**
     * Schedule the campaign
     * Note : the campaign can be scheduled only every 5 minutes
     *
     * @param integer $id
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function scheduleCampaign($id, array $parameters)
    {
        return $this->put(sprintf('campaigns/%s', $id), $parameters);
    }

    /**
     * Unschedule the campaign
     * Note : the campaign can be unschedule until the last minute. After it is not possible anymore.
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function unscheduleCampaign($id)
    {
        return $this->put(sprintf('campaigns/%s', $id));
    }

    /**
     * Get a single contact
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getContact($id)
    {
        return $this->get('contacts/' . $id);
    }

    /**
     * Get a collection of contacts
     *
     * @param array $parameters Default is null
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getContacts(array $parameters = null)
    {
        return $this->get('contacts', $parameters);
    }

    /**
     * Get a contact by email
     *
     * @param string $email
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getContactByEmail($email)
    {
        return $this->get(sprintf('contacts/%s', $email));
    }

    /**
     * Get the contact history
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getContactHistory($id)
    {
        return $this->get(sprintf('contacts/%s/history', $id));
    }

    /**
     * Get the contact summary
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getContactSummary($id)
    {
        return $this->get(sprintf('contacts/%s/summary', $id));
    }

    /**
     * Unsubscribe the contact
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function unsubScribeContact($id)
    {
        return $this->put(sprintf('contacts/%s/unsubscribe', $id));
    }

    /**
     * Create a new contact
     *
     * @param array $parameters
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function createContact(array $parameters)
    {
        return $this->post('contacts', $parameters);
    }

    /**
     * Replace a contact
     *
     * @param integer $id
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function replaceContact($id, array $parameters)
    {
        return $this->put(sprintf('contacts/%s', $id), $parameters);
    }

    /**
     * Update a contact
     *
     * @param integer $id
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function updateContact($id, array $parameters)
    {
        return $this->patch(sprintf('contacts/%s', $id), $parameters);
    }

    /**
     * Remove a contact
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function removeContact($id)
    {
        return $this->delete(sprintf('contacts/%s', $id));
    }

    /**
     * Get a single domain
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getDomain($id)
    {
        return $this->get(sprintf('domains/%s', $id));
    }

    /**
     * Get a collection of domains
     *
     * @param array $parameters Default is null
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getDomains(array $parameters = null)
    {
        return $this->get('domains', $parameters);
    }

    /**
     * Check the domain
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function checkDomain($id)
    {
        return $this->put(sprintf('domains/%s/check', $id));
    }

    /**
     * Get a single invoice
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getInvoice($id)
    {
        return $this->get(sprintf('invoices/%s', $id));
    }

    /**
     * Get a collection of invoices
     *
     * @param array $parameters Default is null
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getInvoices(array $parameters = null)
    {
        return $this->get('invoices', $parameters);
    }

    /**
     * Get a single mailing list
     *
     * @param integet $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getMailingList($id)
    {
        return $this->get(sprintf('mailingLists/%s', $id));
    }

    /**
     * Get a collection of mailing lists
     *
     * @param array $parameters Default is null
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getMailingLists(array $parameters = null)
    {
        return $this->get('mailingLists');
    }

    /**
     * Get a collection of contacts for a given mailing list
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getContactsForMailingList($id)
    {
        return $this->get(sprintf('mailingLists/%s/contacts', $id));
    }

    /**
     * Create a new mailing list
     *
     * @param array $parameters
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function createMailingList(array $parameters)
    {
        return $this->post('mailingLists', $parameters);
    }

    /**
     * Update a mailing list
     *
     * @param integet $id
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function updateMailingList($id, array $parameters)
    {
        return $this->put(sprintf('mailingLists/%s', $id), $parameters);
    }

    /**
     * Remove a mailing list
     *
     * @param integet $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function removeMailingList($id)
    {
        return $this->delete(sprintf('mailingLists/%s', $id));
    }

    /**
     * Get a single sender
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getSender($id)
    {
        return $this->get(sprintf('senders/%s', $id));
    }

    /**
     * Get a collection of senders
     *
     * @param array $parameters Default is null
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getSenders(array $parameters = null)
    {
        return $this->get('senders');
    }

    /**
     * Remove a sender
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function removeSender($id)
    {
        return $this->delete('senders/' . $id);
    }

    /**
     * Get a single template
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getTemplate($id)
    {
        return $this->get(sprintf('templates/%s', $id));
    }

    /**
     * Get a collection of templates
     *
     * @param array $parameters Default is null
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function getTemplates(array $parameters = null)
    {
        return $this->get('templates', $parameters);
    }

    /**
     * Create a new template
     *
     * @param array $parameters
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function createTemplate(array $parameters)
    {
        return $this->post('templates', $parameters);
    }

    /**
     * Update a template
     *
     * @param integer $id
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function updateTemplate($id , array $parameters)
    {
        return $this->patch(sprintf('templates/%s', $id), $parameters);
    }

    /**
     * Replace a template
     *
     * @param integer $id
     * @param array   $parameters
     *
     * @return Mgrt\Api\Response\Response
     */
    public function replaceTemplate($id , array $parameters)
    {
        return $this->put(sprintf('templates/%s', $id), $parameters);
    }

    /**
     * Remove a template
     *
     * @param integer $id
     *
     * @return Mgrt\Api\Response\Response
     */
    public function removeTemplate($id)
    {
        return $this->delete(sprintf('templates/%s', $id));
    }

     /**
     * Hellow world :)
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function helloWorld()
    {
        return $this->get('helloWorld');
    }

    /**
     * Retrieve the internal system date
     *
     * @return Mgrt\Api\Builder\ResultBuilderInterface
     */
    public function systemDate()
    {
        return $this->get('systemDate');
    }
}
