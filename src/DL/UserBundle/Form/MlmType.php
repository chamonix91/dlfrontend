<?php


namespace DL\UserBundle\Form;



use DL\UserBundle\Entity\Mlm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MlmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeparent');
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