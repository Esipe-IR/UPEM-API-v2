<?php

namespace AppBundle\Service\Ldap;

use AppBundle\Model\LdapResponse;
use AppBundle\Model\Student;
use Symfony\Component\Ldap\Ldap;

/**
 * Class LDAPService.
 */
class LdapService implements LdapServiceInterface
{
    /**
     * @var string
     */
    private $dn;

    /**
     * @var Ldap
     */
    private $ldap;

    /**
     * LDAPService constructor.
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
     * @param string $filter
     *
     * @return LdapResponse
     */
    public function query($filter)
    {
        $entries = $this->ldap->query($this->dn, $filter)->execute();

        return static::deserialize($entries->count(), $entries->toArray());
    }

    /**
     * Return a valid ldap filter.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    public function simpleFilter($key, $value)
    {
        return "(".$key."=".$value.")";
    }

    /**
     * Return a valid and ldap filter.
     *
     * @param string $key
     * @param string $value
     * @param string $keyB
     * @param string $valueB
     *
     * @return string
     */
    public function andFilter($key, $value, $keyB = "UmlvWWW", $valueB = "TRUE")
    {
        return "(&($key=$value)($keyB=$valueB))";
    }

    /**
     * Deserialize array of Entry to an array of Student.
     *
     * @param int          $count
     * @param array<Entry> $entries
     *
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
}
