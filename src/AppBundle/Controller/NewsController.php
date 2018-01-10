<?php

	namespace AppBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use AppBundle\Entity\News;
	use AppBundle\Form\NewsType;
	use Symfony\Component\Form\Extension\Core\Type\FormType;
	use Symfony\Component\HttpFoundation\Response;

	

	class NewsController extends Controller{

		/**
     	* @Route("/easyadmin/news", name="news")
     	*/
		public function addAction(Request $request){
			$news = new News();

			$form = $this->createForm(NewsType::class, $news);

			$form->handleRequest($request);

			if($form->isSubmitted()){

				$em = $this->getDoctrine()->getManager();

				$em->persist($news);

				$em->flush();

				return new Response('Article créé');
			}

			$formView = $form->createView();

			 return $this->render('default/news.html.twig', array('form'=>$formView));
		}

		/**
     	* @Route("/showNews", name="showNews")
     	*/
     	public function showAction(Request $request){
			$repository=$this->getDoctrine()->getRepository('AppBundle:News');
			$allnews = $repository->findAll();
			return $this->render('default/showNews.html.twig', array('news'=>$allnews));
		}
	}

?>