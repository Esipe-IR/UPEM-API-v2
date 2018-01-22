<?php

namespace AppBundle\Service;

use AppBundle\Model\Student;
use Symfony\Component\Ldap\Entry;
use Symfony\Component\Ldap\Ldap;

/**
 * Class StudentService
 */
class StudentService
{
    /**
     * @var string
     */
    private $env;

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
     * @param string $env
     * @param string $host
     * @param string $dn
     */
    public function __construct($env, $host, $dn)
    {
        $this->env = $env;
        if ($env !== "dev") {
            $this->ldap = Ldap::create("ext_ldap", ["connection_string" => $host]);
            $this->ldap->bind();
            $this->dn = $dn;
        }
    }

    /**
     * Find students by supannEtuId
     *
     * @param int $supannEtuId
     * @return array<Student>
     */
    public function findBySupannEtuId($supannEtuId)
    {
        if ($this->env === "dev") {
            return $this->deserialize([new Entry($this->dn)]);
        }
        $entries = $this->ldap->query($this->dn, static::defaultFilter(Student::SUPANN_ETU_ID, $supannEtuId))
            ->execute()
            ->toArray();
        return $this->deserialize($entries);
    }

    /**
     * Find students by uid
     *
     * @param int $uid
     * @return array<Student>
     */
    public function findByUid($uid)
    {
        if ($this->env === "dev") {
            return $this->deserialize([new Entry($this->dn)]);
        }
        $entries = $this->ldap->query($this->dn, static::defaultFilter(Student::UID, $uid))
            ->execute()
            ->toArray();
        return $this->deserialize($entries);
    }

    /**
     * Find students by gidNumber
     *
     * @param int $gidNumber
     * @return array<Student>
     */
    public function findByGidNumber($gidNumber)
    {
        if ($this->env === "dev") {
            return $this->deserialize([new Entry($this->dn)]);
        }
        $entries = $this->ldap->query($this->dn, static::simpleFilter(Student::GID_NUMBER, $gidNumber))
            ->execute()
            ->toArray();
        return $this->deserialize($entries);
    }

    /**
     * Deserialize array of Entry to array of Student
     *
     * @param array<Entry> $entries
     * @return array<Student>
     */
    private static function deserialize($entries)
    {
        $students = [];
        foreach ($entries as $entry) {
            $students[] = Student::deserialize($entry);
        }
        return $students;
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
