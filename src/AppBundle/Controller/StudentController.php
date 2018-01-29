<?php

namespace AppBundle\Controller;

use AppBundle\Service\StudentService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StudentController
 *
 * @Rest\Route("/api/v2/student")
 */
class StudentController extends FOSRestController
{
    /**
     * @Rest\Get("/me")
     *
     * @return \FOS\RestBundle\View\View
     */
    public function meAction()
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->view(null, Response::HTTP_UNAUTHORIZED);
        }

        return $this->view($user, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/supannEtuId/{supannEtuId}")
     *
     * @param StudentService $service
     * @param int            $supannEtuId
     *
     * @return \FOS\RestBundle\View\View
     */
    public function supannEtuIdAction(StudentService $service, $supannEtuId)
    {
        $data = $service->findBySupannEtuId($supannEtuId);
        if ($data->isEmpty()) {
            return $this->view(null, Response::HTTP_NOT_FOUND);
        }

        return $this->view($data, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/uid/{uid}")
     *
     * @param StudentService $service
     * @param string         $uid
     *
     * @return \FOS\RestBundle\View\View
     */
    public function uidAction(StudentService $service, $uid)
    {
        $data = $service->findByUid($uid);
        if ($data->isEmpty()) {
            return $this->view(null, Response::HTTP_NOT_FOUND);
        }

        return $this->view($data, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("gidNumber/{gidNumber}")
     *
     * @param StudentService $service
     * @param int            $gidNumber
     *
     * @return \FOS\RestBundle\View\View
     */
    public function gidNumberAction(StudentService $service, $gidNumber)
    {
        $data = $service->findByGidNumber($gidNumber);
        if ($data->isEmpty()) {
            return $this->view(null, Response::HTTP_NOT_FOUND);
        }

        return $this->view($data, Response::HTTP_OK);
    }
}
