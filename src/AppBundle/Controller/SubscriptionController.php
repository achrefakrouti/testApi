<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;

/**
 * Subscription controller.
 *
 * @Route("subscription")
 */
class SubscriptionController extends Controller
{


    /**
     * @Post(
     *     path = "/",
     *     name = "subscription_new",
     *
     * )
     * @View
     */
    public function newAction(Request $request)
    {
        $subscription = new Subscription();
        //  $form = $this->createForm('AppBundle\Form\SubscriptionType', $subscription);
        //  $form->handleRequest($request);

        //  if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($subscription);
        $em->flush();
        return $subscription;
//            $serializer = $this->container->get('jms_serializer');
//            $serializedEntity = $serializer->serialize($subscription->getId(), 'json');
//            return  new response($serializedEntity,200, array('Content-Type' => 'application/json'));

        //  }

//        return $this->render('subscription/new.html.twig', array(
//            'subscription' => $subscription,
//            'form' => $form->createView(),
//        ));
    }


    /**
     * @Get(
     *     path = "/{id}",
     *     name = "subscription_show",
     *     requirements = {"id"="\d+"}
     *     )
     * )
     * @View
     */


    public function showAction($id, Subscription $subscription)
    {
        return $this->get('app.subscription.service')->show($subscription);
//        $em = $this->get('doctrine.orm.entity_manager');
//        $subscription = $em->getRepository('AppBundle:Subscription')
//         ->find($id);
//        $serializer = $this->container->get('jms_serializer');
//        $serializedEntity = $serializer->serialize($subscription, 'json');
//        return  new response($serializedEntity,200, array('Content-Type' => 'application/json'));

    }


    /**
     * @Put(
     *     path = "/{id}/",
     *     name = "subscription_edit",
     *
     * )
     * @View
     */
    public function editAction(Request $request, Subscription $subscription)
    {

//        $editForm = $this->createForm('AppBundle\Form\SubscriptionType', $subscription);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
        $em = $this->get('doctrine.orm.entity_manager');
        $subscription = $em->getRepository('AppBundle:Subscription')
            ->find($request->get('id'));
        $em->flush();


        return $subscription;
        /// }
//        return $this->render('subscription/edit.html.twig', array(
//            'subscription' => $subscription,
//            'editform' => $editForm->createView(),
//        ));

    }


    /**
     * @Delete(
     *     path = "/{id}/delete/",
     *     name = "subscription_delete",
     *
     * )
     * @View
     */
    public function deleteAction($id)
    {
        // $form = $this->createForm($subscription);
        //  $form->handleRequest($request)

        //   if ($form->isSubmitted() && $form->isValid()) {

        return $this->get('app.subscription.service')->delete($id);
    }


}
