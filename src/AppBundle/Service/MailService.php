<?php

namespace AppBundle\Service;

/**
 * Class MailService.
 */
class MailService
{
    /**
     * @param string $to
     * @param string $from
     * @param string $subject
     * @param string $message
     *
     * @return bool
     */
    public function send($to, $from, $subject, $message)
    {
        $headers = 'From: '.$from."\r\n".'Reply-To: '.$from."\r\n".'X-Mailer: PHP/'.phpversion();

        return mail($to, $subject, $message, $headers);
    }
}
