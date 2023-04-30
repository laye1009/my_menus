<?php


namespace App\MessageHandler;

use App\Message\MessageNotification;
use Symfony\Component\Mailer\MailerInterface;


class MessageNotificationHandler
{
    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(MessageNotification $message)
    {
        /*$mail = (new Email())
            ->from($message->getFrom())
            ->to('layekebe98@hotmail.com')
            ->subject("Nouveau incident".$message->getId(). "créé par ".$message->getFrom())
            ->html('<p>'.$message->getDescription().'</p>');

        
        sleep(10);
            $this->mailer->send($mail);
            */

    }

}