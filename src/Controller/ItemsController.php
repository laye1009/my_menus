<?php

namespace App\Controller;

use App\Entity\Items;
use App\Entity\Comments;
use App\Repository\ItemsRepository;
use App\Repository\CommentsRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ItemsController extends AbstractController
{
    /**
    * @Route("/items", name="home")
    */

    public function index(ObjectManager $manager, ItemsRepository $itemsrepo): Response
    {
        $items = $itemsrepo->findAll();
        //var_dump($items);die();

        return $this->render('items/items.html.twig', [
            'items' => $items,
        ]);
    }
    /**
     * @Route("/items/{id}", name="show_item")
     */
    public function getItem(Items $item,CommentsRepository $comment): Response
    {
        //$comment = $this->getDoctrine()->getRepository(CommentsRepository::class);
        //$item = $repo->findOneById(array('34'));
        //var_dump($request->query->get('id'));
        $commandes=$item->getOrders();
        $cmds=array();
        foreach($commandes as $k=>$v){
            $cmds[] = $v->getId();
        }
        for($i=0;$i<count($cmds);$i++)
        {
            //$comments[]=$comment->findBy([ 'c_order' => $cmds[$i] ]);
            $notes=$comment->getOrderId($cmds[$i]);
        }
        //var_dump($notes);die();
        return $this->render('items/getItem.html.twig', [
            'item' => $item,
            'commandes'=>$commandes,
            'notes'=>$notes,
        ]);
    }
    /*
    public function panier(Comments $comment,Items $item, SessionInterface $session)
    {
        //$session->set('panier',array());
        $panier = array();
        $nb = 0;
        if(!array_key_exists($item->getId(),$panier))
        {
            $panier[$item->getId()]= array();
            $commandes=$item->getOrders();
            $cmds=array();
            foreach($commandes as $k=>$v){
                $cmds[] = $v->getId();
            }
            $panier[$item->getId()]['commande'] = $cmds;
            $panier['nb'] = $nb + 1;

        }
        //var_dump($panier);die();
        $notes=array();
        for($i=0;$i<count($cmds);$i++)
        {
            //$comments[]=$comment->findBy([ 'c_order' => $cmds[$i] ]);
            $notes[]=$comment->getOrderId($cmds[$i]);
        }

        return $this->render('items/panier.html.twig', [
            'item' => $item,
            'commandes'=>$commandes,
            'notes'=>$notes,
            'panier'=>$panier,
        ]);


    }*/
}
