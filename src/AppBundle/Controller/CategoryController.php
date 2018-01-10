<?php

	namespace AppBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use AppBundle\Entity\Category;
	use AppBundle\Form\CategoryType;
	use Symfony\Component\Form\Extension\Core\Type\FormType;
	use Symfony\Component\HttpFoundation\Response;

	

	class CategoryController extends Controller{

		/**
     	* @Route("/easyadmin/category", name="category")
     	*/
		public function addAction(Request $request){
			$category = new Category();

			$form = $this->createForm(CategoryType::class, $category);

			$form->handleRequest($request);

			if($form->isSubmitted()){

				$em = $this->getDoctrine()->getManager();

				$em->persist($category);

				$em->flush();

				return new Response('Catégorie créée');
			}

			$formView = $form->createView();

			 return $this->render('default/category.html.twig', array('form'=>$formView));
		}

		/**
     	* @Route("/showCategory", name="showCategory")
     	*/
     	public function showAction(Request $request){
			$repository=$this->getDoctrine()->getRepository('AppBundle:Category');
			$allcategory = $repository->findAll();
			return $this->render('default/showCategory.html.twig', array('category'=>$allcategory));
		}
	}

?>