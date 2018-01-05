<?php

namespace Lexik\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OC\PlatformBundle\Repository\CategoryRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Group_nameType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users', EntityType::class, array(
                'class' => 'LexikTestBundle:User',
                'choice_label'  => 'surname',
                'multiple'      => true,
                'expanded'      => true,
            ))
            ->add('Supprimer', SubmitType::class)
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lexik\TestBundle\Entity\Group_name'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lexik_testbundle_group_name';
    }


}
