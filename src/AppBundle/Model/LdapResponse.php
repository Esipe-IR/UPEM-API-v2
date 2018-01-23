<?php

namespace AppBundle\Model;

/**
 * Class LdapResponse
 */
class LdapResponse
{
    /**
     * @var int
     */
    private $count;

    /**
     * @var array
     */
    private $data;

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return LdapResponse
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return LdapResponse
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->count < 1;
    }
}
