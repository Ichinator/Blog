<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;

class NewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, array('label' => 'Titre de l\'article '))
        ->add('author', TextType::class, array('label' => 'Auteur de l\'article '))
        ->add('content', FroalaEditorType::class, array('label' => 'Contenu de l\'article '))
        ->add('published', CheckboxType::class, array('label' => 'Cocher pour publier '))
        ->add('categoryName', TextType::class, array('label' => 'Catégorie de l\'article '))
        ->add('dateCreate', DateTimeType::class)
        /*->add( "Froala", FroalaEditorType::class)*/
        ->add('submit', SubmitType::class, array('label' => 'Go '));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\News'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_news';
    }


}
