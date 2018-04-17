<?php

namespace MA\MainBundle\Form;


use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    /*private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }*/

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emailAdress', EmailType::class, array(
                'attr' => array(
                    'placeholder' => 'Saisir votre adresse email')
            ))
            ->add('message', TextareaType::class, array(
                'attr' => array(
                    'placeholder' => 'Saisir votre message...',
                    'size' => '1000')
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'compound' => true,
        ));
    }

    public function getParent()
    {
        return TextType::class;
    }


}