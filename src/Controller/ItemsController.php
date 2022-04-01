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

    /**
     * @Route("/panier/voir",name="show_panier")
     */

     public function voirPanier(ItemsRepository $itemRepo,Request $request)
     {
        $form = $request->request;
        $para = $form->get('id');
        $para = explode(",",$para);
        $para = array_unique($para);
        $result=array();
        /*
        $output = '<table>
        <thead>
        <tr>
        <th>Name</th><th>Description></th>
        </tr></thead>';
        $output.='<tbody>';*/
        for($i=0;$i<count($para);$i++)
        {
            $item = $itemRepo->findOneBy(array('id'=>$para[$i]));
            //$output.='<tr>';
            
            //$item = $itemRepo->findOneBy(array('id'=>$para[$i]));
            $result[$i]['name']=$item->getName();
            $result[$i]['description']=$item->getDescription();
            $result[$i]['prix']=$item->getPrice();
            /*$output.='<td>'.$item->getName().'</td><td>'.$item->getDescription().'</td>';
            $output.='</tr>';
            //$result[$i] = $i; */
        }
        /*$output.='</tbody></table>';
        $result[count($para)]['output'] = $output;*/
        
        //$res=$this->get('normaliser')->normalize($result);
        
        return new Response(json_encode($result));
        //return new Response(json_encode($result));
        //return new JsonResponse($res);
        //var_dump($para);die();
        //echo new JsonResponse($response);
        //return new JsonResponse($response);
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
