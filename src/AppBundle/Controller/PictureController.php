<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Picture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PictureController extends Controller
{
    /**
     * @Route("/picture/add", name="picture_add")
     */
    public function pictureAddAction(Request $request)
    {


        $picture = new Picture();

        $form = $this->createFormBuilder($picture)
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Add this picture'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $picture = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($picture);
            $em->flush();
            return $this->redirectToRoute('picture_show');
        }




        return $this->render("AppBundle:Picture:picture_add_form.html.twig", array(
            'form' => $form->createView(),
        ));
    }








    /**
     * @Route("/picture/show", name="picture_show")
     */
    public function pictureShowAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Picture::class);
        $pictures = $repository->findAll();

        return $this->render("AppBundle:Picture:picture_show.html.twig", array(
            "pictures" => $pictures,
        ));
    }

}
