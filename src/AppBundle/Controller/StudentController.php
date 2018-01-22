<?php

namespace AppBundle\Controller;

use AppBundle\Service\StudentService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StudentController
 *
 * @Rest\Route("/api/student")
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
            return $this->view(null, Response::HTTP_BAD_REQUEST);
        }
        return $this->view($user, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/search")
     * @Rest\QueryParam(name="supannEtuId", requirements="\d+", description="SupannEtuId of the student")
     * @Rest\QueryParam(name="uid", description="UID of the student")
     * @Rest\QueryParam(name="gidNumber", requirements="\d+", description="GidNumber of the student")
     *
     * @param StudentService $service
     * @param ParamFetcherInterface $fetcher
     *
     * @return \FOS\RestBundle\View\View
     */
    public function searchAction(StudentService $service, ParamFetcherInterface $fetcher)
    {
        $data = [];
        if (!empty($supannEtuId = $fetcher->get("supannEtuId"))) {
            $data = $service->findBySupannEtuId($supannEtuId);
        } else if (!empty($uid = $fetcher->get("uid"))) {
            $data = $service->findByUid($uid);
        } else if (!empty($gidNumber = $fetcher->get("gidNumber"))) {
            $data = $service->findByGidNumber($gidNumber);
        }

        return $this->view($data, Response::HTTP_OK);
    }
}
