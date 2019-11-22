<?php

namespace AppBundle\Service;


use AppBundle\Entity\Subscription;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class SubscriptionService
{

    private $container;
    private $em;
    private $doctrine;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->doctrine = $this->container->get('doctrine');
        $this->em = $this->doctrine->getManager();
    }

    public function show(Subscription $subscription)
    {
        $this->doctrine->getConnection()->beginTransaction();
        try {
            return $subscription;
        } catch (\Exception $e) {
            $this->doctrine->getConnection()->rollBack();
            $response = new Response();
            $response->setContent(json_encode(array(
                'message' => $e->getMessage()
            )));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }


    public function delete($id)
    {
        $this->doctrine->getConnection()->beginTransaction();
        try {
            $subscription = $this->$em->getRepository('AppBundle:Subscription')
                ->find($id);
            $em->remove($subscription);
            $em->flush();
        } catch (\Exception $e) {
            $this->doctrine->getConnection()->rollBack();
            $response = new Response();
            $response->setContent(json_encode(array(
                'message' => $e->getMessage()
            )));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }
}
