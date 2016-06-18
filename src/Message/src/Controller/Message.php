<?php
declare(strict_types = 1);

namespace Message\Controller;

use Silex\Application;
use Common\Response as View;

/**
 * Message Controller
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
final class Message
{
    /**
     * Route to /message/
     *
     * @param  Application $app
     * @return View
     */
    public function get(Application $app): View
    {
        /* @var $messages array */
        $messages    = $app['message.service']->listAll();

        return new View($messages, View::HTTP_OK);
    }

    /**
     * Retrieves information from message
     *
     * @param  Application $app
     * @return View
     */
    public function view(Application $app): View
    {
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $app['request'];

        /* @var $id int */
        $id      = (int) $request->get('id');

        /* @var $message \Message\Entity\MessageInterface */
        $message    = $app['message.service']->findByMessageId($id);

        return new View($message, View::HTTP_OK);
    }
    /**
     * Create new Message
     *
     * @param  Application $app
     * @return View
     */
    public function create(Application $app): View
    {
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $app['request'];

        $name    = $request->get('name');
        $email   = $request->get('email');

        /* @var $message \Message\Entity\MessageInterface */
        $message    = $app['message.service']->create($name, $email);

        return new View($message, View::HTTP_CREATED);
    }
}
