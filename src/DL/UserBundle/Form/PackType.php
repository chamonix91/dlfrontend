<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 12/02/2018
 * Time: 10:33
 */

namespace DL\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Mlm::class,
        ));
    }



    public function getBlockPrefix()
    {
        return 'app_user_mlm';
    }




}