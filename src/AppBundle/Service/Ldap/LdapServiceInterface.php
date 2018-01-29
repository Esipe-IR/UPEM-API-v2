<?php

namespace AppBundle\Service\Ldap;

use AppBundle\Model\LdapResponse;

/**
 * Interface LDAPServiceInterface.
 */
interface LdapServiceInterface
{
    /**
     * @param string $filter
     *
     * @return LdapResponse
     */
    public function query($filter);

    /**
     * Return a valid ldap filter.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    public function simpleFilter($key, $value);

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
    public function andFilter($key, $value, $keyB = "UmlvWWW", $valueB = "TRUE");
}
