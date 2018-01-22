<?php

namespace AppBundle\Model;

use Symfony\Component\Ldap\Entry;

/**
 * Class Student
 */
class Student
{
    const SUPANN_ETU_ID = "supannetuid";
    const UID = "uid";
    const GIVEN_NAME = "givenname";
    const SN = "sn";
    const GID_NUMBER = "gidnumber";
    const MAIL = "mail";
    const HOME_DIRECTORY = "homedirectory";
    const ACCOUNT_STATUS = "accountstatus";

    /**
     * @var int
     */
    private $supannEtuId;

    /**
     * @var string
     */
    private $uid;

    /**
     * @var string
     */
    private $givenName;

    /**
     * @var string
     */
    private $sn;

    /**
     * @var int
     */
    private $gidNumber;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $homeDirectory;

    /**
     * @var bool
     */
    private $accountStatus;

    /**
     * @return int
     */
    public function getSupannEtuId()
    {
        return $this->supannEtuId;
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getGivenName()
    {
        return $this->givenName;
    }

    /**
     * @return string
     */
    public function getSn()
    {
        return $this->sn;
    }

    /**
     * @return int
     */
    public function getGidNumber()
    {
        return $this->gidNumber;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return string
     */
    public function getHomeDirectory()
    {
        return $this->homeDirectory;
    }

    /**
     * @return bool
     */
    public function getAccountStatus()
    {
        return $this->accountStatus;
    }

    /**
     * Should deserialize an Entry into Student
     *
     * @param Entry $entry
     * @return Student
     */
    public static function deserialize(Entry $entry)
    {
        $student = new Student();
        if ($entry->hasAttribute(self::SUPANN_ETU_ID)) {
            $student->supannEtuId = $entry->getAttribute(self::SUPANN_ETU_ID)[0];
        }
        if ($entry->hasAttribute(self::UID)) {
            $student->uid = $entry->getAttribute(self::UID)[0];
        }
        if ($entry->hasAttribute(self::GIVEN_NAME)) {
            $student->givenName = $entry->getAttribute(self::GIVEN_NAME)[0];
        }
        if ($entry->hasAttribute(self::SN)) {
            $student->sn = $entry->getAttribute(self::SN)[0];
        }
        if ($entry->hasAttribute(self::GID_NUMBER)) {
            $student->gidNumber = $entry->getAttribute(self::GID_NUMBER)[0];
        }
        if ($entry->hasAttribute(self::MAIL)) {
            $student->mail = $entry->getAttribute(self::MAIL)[0];
        }
        if ($entry->hasAttribute(self::HOME_DIRECTORY)) {
            $student->homeDirectory = $entry->getAttribute(self::HOME_DIRECTORY)[0];
        }
        if ($entry->hasAttribute(self::ACCOUNT_STATUS)) {
            $student->accountStatus = $entry->getAttribute(self::ACCOUNT_STATUS)[0];
        }

        return $student;
    }
}
