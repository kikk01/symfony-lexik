<?php

namespace Lexik\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname',        TextType::class)
            ->add('name',           TextType::class)
            ->add('email',          EmailType::class)
            ->add('birthDate',      DateType::class, array(
                'widget'        => 'choice',
                'years'         => range(1940, 2005)
            ))
            ->add('group',         EntityType::class, array(
                'class'         => 'LexikTestBundle:Group_name',
                'choice_label'  => 'name'
            ))
            ->add('Valider',        SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lexik\TestBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lexik_testbundle_user';
    }
}
