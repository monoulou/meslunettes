<?php

namespace MA\MainBundle\Form;


use MA\MainBundle\Entity\Places;
use MA\MainBundle\Form\MarqueType;
use MA\MainBundle\Repository\MarqueRepository;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MA\MainBundle\Form\PlacesType;


class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dump($builder);die();
        $builder
            ->add('titre', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Titre de l\'annonce')))
            ->add('marque', MarqueType::class)
            
            ->add('modele', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Modele')))
            ->add('etat', ChoiceType::class, array(
                'choices' => array('Neuf' => 'n', 'Occasion' => 'o'),
                'expanded' => true,
                'multiple' => false ))
            ->add('prix',TextType::class, array(
                'attr' => array(
                    'class' => 'money',
                    'placeholder' => 'Prix de vente')))
            ->add('telephone', TextType::class, array(
                'attr' => array(
                    'class' => 'phone',
                    'placeholder' => 'N° Tel')))
            ->add('email', EmailType::class, array(
                'attr' => array( 'placeholder' => 'Adresse email')))
            
            ->add('description', TextareaType::class, array(
                'attr' => array(
                    'placeholder' => 'Description du produit...',
                    'maxlength' => 2000)))

            ->add('imagePrincipale',FileType::class, array(
                'data_class' => null,
                'label' => false,
                'required' => true,
                'attr' => array(
                    'type' => 'file',
                    'placeholder' => 'Selectionner une image',
                    'data-preview-file-type' => 'text',
                    'data-allowed-file-extensions' => '["jpeg", "png", "jpg"]',
                )
            ))
            ->add('imageBis',FileType::class, array(
                'data_class' => null,
                'label' => false,
                'required' => false,
                'attr' => array(
                    'type' => 'file',
                    'data-preview-file-type' => 'text',
                    'data-allowed-file-extensions' => '["jpeg", "png", "jpg"]',
                )
            ))
            ->add('imageTer',FileType::class, array(
                'data_class' => null,
                'label' => false,
                'required' => false,
                'attr' => array(
                    'type' => 'file',
                    'data-preview-file-type' => 'text',
                    'data-allowed-file-extensions' => '["jpeg", "png", "jpg"]',
                )))

            ->add('place', PlacesType::class);
            /*->add('cp', PlacesType::class, array(
                //'data_class' => null,
                ));*/
            /*->add('place', CollectionType::class, array(
                'data_class' => PlacesType::class,
                'attr' => array('label' => 'Adresse'),
                //'allow_add' => true,
                ));*/
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MA\MainBundle\Entity\Annonce',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ma_mainbundle_annonce';
    }


}
