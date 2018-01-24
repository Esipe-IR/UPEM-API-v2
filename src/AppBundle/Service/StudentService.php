<?php

namespace AppBundle\Service;

use AppBundle\Model\LdapResponse;
use AppBundle\Model\Student;
use Symfony\Component\Ldap\Ldap;

/**
 * Class StudentService
 */
class StudentService
{
    /**
     * @var Ldap
     */
    private $ldap;

    /**
     * @var string
     */
    private $dn;

    /**
     * StudentService constructor
     *
     * @param string $host
     * @param string $dn
     */
    public function __construct($host, $dn)
    {
        $this->ldap = Ldap::create("ext_ldap", ["connection_string" => $host]);
        $this->ldap->bind();
        $this->dn = $dn;
    }

    /**
     * Find students by supannEtuId
     *
     * @param int $supannEtuId
     * @return LdapResponse
     */
    public function findBySupannEtuId($supannEtuId)
    {
        $filter = static::simpleFilter(Student::SUPANN_ETU_ID, $supannEtuId);
        $entries = $this->ldap->query($this->dn, $filter)->execute();

        return $this->deserialize($entries->count(), $entries->toArray());
    }

    /**
     * Find students by uid
     *
     * @param int $uid
     * @return LdapResponse
     */
    public function findByUid($uid)
    {
        $filter = static::simpleFilter(Student::UID, $uid);
        $entries = $this->ldap->query($this->dn, $filter)->execute();

        return $this->deserialize($entries->count(), $entries->toArray());
    }

    /**
     * Find students by gidNumber
     *
     * @param int $gidNumber
     * @return LdapResponse
     */
    public function findByGidNumber($gidNumber)
    {
        $filter = static::simpleFilter(Student::GID_NUMBER, $gidNumber);
        $entries = $this->ldap->query($this->dn, $filter)->execute();

        return $this->deserialize($entries->count(), $entries->toArray());
    }

    /**
     * Deserialize array of Entry to array of Student
     *
     * @param array<Entry> $entries
     * @return LdapResponse
     */
    private static function deserialize($count, $entries)
    {
        $students = [];
        foreach ($entries as $entry) {
            $students[] = Student::deserialize($entry);
        }
        $ldapResponse = new LdapResponse();
        $ldapResponse
            ->setCount($count)
            ->setData($students)
        ;
        return $ldapResponse;
    }

    /**
     * Return a valid LDAP filter with default domain
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    private static function defaultFilter($key, $value)
    {
        return "(&(".$key."=".$value.")(UmlvWWW=TRUE))";
    }

    /**
     * Return a valid LDAP filter
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    private static function simpleFilter($key, $value)
    {
        return "(".$key."=".$value.")";
    }
}
