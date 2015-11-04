<?php

namespace Pcimagenca\ChatBundle\Controller;
use Pcimagenca\ChatBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/chat")
 */
class ChatController extends Controller
{
    /**
     * @return Response
     *
     * @Route("", name="pcimagenca_chat", defaults={"channel" = "default"})
     * @Template
     */
     public function indexAction()
    {
        
        return $this->render('PcimagencaChatBundle:Chat:index.html.twig');
    }
    /**
     * @return Response
     *
     * @Route("/{channel}", name="pcimagenca_chat_show", defaults={"channel" = "default"})
     * @Template
     */
    public function showAction($channel)
    {
        return array(
            'updateInterval' => $this->container->getParameter('pcimagenca_chat.update_interval'),
            'channel' => $channel
        );
    }
    /**
     * @param Request $request
     *
     * @return RedirectResponse
     *
     * @Route("/post/{channel}", name="pcimagenca_chat_post", defaults={"channel" = "default"})
     */
    public function postAction(Request $request, $channel)
    {
        $message = new Message();
        $message->setAuthor($this->getUser());
        $message->setChannel($channel);
        $message->setMessage($request->get('message'));
        $message->setInsertDate(new \DateTime());
        $this->getDoctrine()->getManager()->persist($message);
        $this->getDoctrine()->getManager()->flush();
        return new Response('Successful');
    }
    /**
     * @Route("/list/{channel}", name="pcimagenca_chat_list", defaults={"channel" = "default"})
     * @Template
     */
    public function listAction($channel)
    {
        $messages = $this->getDoctrine()->getRepository('pcimagencaChatBundle:Message')->findBy(
            array('channel' => $channel),
            array('id' => 'desc'),
            $this->container->getParameter('pcimagenca_chat.number_of_messages')
        );
        return array(
            'messages' => $messages,
        );
    }
}