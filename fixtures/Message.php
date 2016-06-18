<?php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Message\Entity\Message as MessageModel;

/**
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
class Message extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Loader
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $i      = 1;

        while ($i <= 10) {
            $message   = [
                'title' => 'Message ' . $i,
                'text' => 'message text ' . $i,
            ];

            $obj = new MessageModel();
            $obj->setTitle($message['title']);
            $obj->setText($message['text']);

            $manager->persist($obj);
            $manager->flush();

            $this->addReference('message_' . $i, $obj);

            $i++;
        }
    }

    /**
     * Load order
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
