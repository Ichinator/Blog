<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\News;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/news", name="news")
     */
    public function addAction(Request $request)

  {

    $news = new News();


    // On crée le FormBuilder grâce au service form factory

    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $news);


    // On ajoute les champs de l'entité que l'on veut à notre formulaire

    $formBuilder

      ->add('date',      DateType::class)

      ->add('title',     TextType::class)

      ->add('content',   TextareaType::class)

      ->add('author',    TextType::class)

      ->add('published', CheckboxType::class)

      ->add('save',      SubmitType::class)

    ;

    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard


    // À partir du formBuilder, on génère le formulaire

    $form = $formBuilder->getForm();


    // On passe la méthode createView() du formulaire à la vue

    // afin qu'elle puisse afficher le formulaire toute seule

    return $this->render('default/news.html.twig', array(

      'form' => $form->createView(),

    ));

  }
}
