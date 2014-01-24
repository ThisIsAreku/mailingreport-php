<?php

namespace Mgrt\Model;

use Mgrt\Model\BaseModel;
use Mgrt\Model\MailingList;

class Contact extends BaseModel
{
    protected $id;
    protected $email;
    protected $mailing_lists = array();
    protected $custom_fields = array();
    protected $latitude;
    protected $longitude;
    protected $country_code;
    protected $time_zone;
    protected $created_at;
    protected $updated_at;

    public function addMailingList(MailingList $mailingList)
    {
        $this->mailing_lists = array_merge($this->mailing_lists, array($mailingList->getId() => $mailingList));

        return $this;
    }

    public function setMailingLists(array $datas)
    {
        foreach ($datas as $key => $value) {
            if ($value instanceof MailingList) {
                $this->mailing_lists[$value->getId()] = $value;
            } else {
                $mailingList = new MailingList();
                $mailingList->fromArray($value);
                $this->mailing_lists[$mailingList->getId()] = $mailingList;
            }
        }
    }

    public function setCustomFields(array $datas)
    {
        foreach ($datas as $key => $value) {
            if ($value instanceof CustomField) {
                $this->custom_fields[] = $value;
            } else {
                $customField = new CustomField();
                $this->custom_fields[] = $customField->fromArray($value);
            }
        }
    }

    public function getCustomFieldsToArray()
    {
        $custom_fields = $this->getCustomFields();
        array_walk($custom_fields, function(&$customField) {
            $customField = array(
                'id' => $customField->getId(),
                'value' => $customField->getValue(),
            );
        });

        return $custom_fields;
    }

    public function getMailingListsToArray()
    {
        $mailing_lists = $this->getMailingLists();
        array_walk($mailing_lists, function(&$mailingList) {
            $mailingList = $mailingList->getId();
        });

        return $mailing_lists;
    }
}
