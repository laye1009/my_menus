<?php

namespace App\Controller;

use App\Entity\Items;
use App\Form\ItemsType;
use App\Service\UploaderHelper;
use App\Repository\ItemsRepository;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(Request $request,PaginatorInterface $paginator,ItemsRepository $itRepo): Response
    {
        $itemsList = $itRepo->findAll();
        $items = $paginator->paginate($itemsList,$request->query->getInt('page',1),10);
        return $this->render('admin/admin.html.twig', [
            'items'=> $items,
        ]);
    }
    /**
     * @Route("/admin/create",name="item_create")
     */

    public function createItem(UploaderHelper $uploader,Request $request,ObjectManager $manager,SluggerInterface $slug)
    {
        $item = new Items();
        $form = $this->createForm(ItemsType::class,$item);
        $form->handleRequest($request);
        $image = $form->get('image')->getData();
        if($form->isSubmitted() && $form->isValid())
        {
            $newsafename=$uploader->upload($slug,$image);
            $item->setImage($newsafename);
            $manager->persist($item);
            $manager->flush();
            $this->addFlash("success","Le produit a été ajouté");
            return $this->redirectToRoute('home');
        }
        return $this->render('items/create_item.html.twig',[
            'form'=>$form->createView()
        ]);
    }


    /**
     * @Route("/admin/delete/{id}",name="admin_delete")
     */

    public function delete(Items $item, ObjectManager $em)
    {
        $em->remove($item);
        $em->flush();
        return $this->redirectToRoute('app_admin');
        

    }

    /**
     * @Route("/admin/edit/{id}", name="admin_edit")
     */
    public function edit(UploaderHelper $uploader,Request $request,Items $item, ObjectManager $em)
    {
        $form = $this->createForm(ItemsType::class,$item);
        $oldIm = $item->getImage();
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid())
        {
            $file = $form->get('image')->getData();
            if ($file) $filename=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            if($file && $filename.$file->guessExtension() !== $oldIm)
            {
                $oldIm = $newsafename=$uploader->upload($slug,$image);
            }
            $item = $form->getData();
            $item->setImage($oldIm);
            $em->persist($item);
            $em->flush();
            $this->addFlash('success','Modification effectuée');

        }
        return $this->render('admin/edit.html.twig',[
            'form'=>$form->createView()
        ]);
        
    }
}
