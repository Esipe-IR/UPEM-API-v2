<?php

namespace AppBundle\Service;

use AppBundle\Model\LdapResponse;
use AppBundle\Model\Student;
use AppBundle\Service\Ldap\LdapServiceInterface;

/**
 * Class StudentService
 */
class StudentService
{
    /**
     * @var LdapServiceInterface
     */
    private $ldap;

    /**
     * StudentService constructor
     *
     * @param LdapServiceInterface $ldapService
     */
    public function __construct(LdapServiceInterface $ldapService)
    {
        $this->ldap = $ldapService;
    }

    /**
     * Find students by supannEtuId
     *
     * @param int $supannEtuId
     *
     * @return LdapResponse
     */
    public function findBySupannEtuId($supannEtuId)
    {
        return $this->ldap->query($this->ldap->simpleFilter(Student::SUPANN_ETU_ID, $supannEtuId));
    }

    /**
     * Find students by uid
     *
     * @param int $uid
     *
     * @return LdapResponse
     */
    public function findByUid($uid)
    {
        return $this->ldap->query($this->ldap->simpleFilter(Student::UID, $uid));
    }

    /**
     * Find students by gidNumber
     *
     * @param int $gidNumber
     *
     * @return LdapResponse
     */
    public function findByGidNumber($gidNumber)
    {
        return $this->ldap->query($this->ldap->simpleFilter(Student::GID_NUMBER, $gidNumber));
    }
}
