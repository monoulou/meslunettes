<?php

namespace MA\MainBundle\Form;

use MA\MainBundle\Form\DataTransformer\PlacesTransformer;
use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlacesType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->addModelTransformer( new PlacesTransformer($this->manager), true)
            ->add('adress', TextType::class)
            ->add('street_number', TextType::class)
            ->add('route', TextType::class)
            ->add('locality', TextType::class)
            ->add('postal_code', TextType::class)
            ->add('administrative_area_level_1', TextType::class)
            ->add('country', TextType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MA\MainBundle\Entity\Places'
            //'data_class' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ma_mainbundle_places';
    }


}
