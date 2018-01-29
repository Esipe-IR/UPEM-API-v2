<?php

namespace AppBundle\Controller;

use AppBundle\Service\MailService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MailController.
 *
 * @Rest\Route("/api/v2/mail")
 */
class MailController extends FOSRestController
{
    /**
     * @Rest\Post("/send")
     *
     * @param ParamFetcherInterface $fetcher
     * @param MailService           $mail
     *
     * @return \FOS\RestBundle\View\View
     */
    public function sendAction(ParamFetcherInterface $fetcher, MailService $mail)
    {
        $response = $mail->send(
            $fetcher->get('to'),
            $fetcher->get('from'),
            $fetcher->get('subject'),
            $fetcher->get('message')
        );

        return $this->view($response, Response::HTTP_OK);
    }
}
