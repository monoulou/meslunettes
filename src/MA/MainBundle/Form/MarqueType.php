<?php

namespace MA\MainBundle\Form;


use Doctrine\Common\Persistence\ObjectManager;
use MA\MainBundle\Entity\Marque;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use MA\MainBundle\Repository\MarqueRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarqueType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $manager)
    {
        $this->em = $manager;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //dump($builder);die();
        $builder->add('name',EntityType::class, array(
            'label' => false,
            'class' => 'MAMainBundle:Marque',
            'placeholder' => 'Marque',
            'query_builder' => function (MarqueRepository $mr) {
                return $mr->createQueryBuilder('m')
                    ->select('m')
                    ->orderBy('m.name', 'ASC');
            },
            'choice_label' => function ($marque) {
                return $marque->getName();
            },
        ));

     

    }
    /**
    * {@inheritdoc}
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MA\MainBundle\Entity\Marque'
            //'data_class' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ma_mainbundle_marque';
    }


}
