<?php


namespace DL\UserBundle\Form;


use DL\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use DL\UserBundle\Form\MlmType;
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       

        $builder

            ->add('emailenrolleur',EmailType::class, array('label' => 'Email enrolleur'))
            ->add('emaildirect',EmailType::class, array('label' => 'Email direct'))
            ->add('email', EmailType::class, array('label' => 'Votre email'))
            ->add('email', RepeatedType::class, array(
                'first_options'  => array('label' => 'Votre Email'),
                'second_options' => array('label' => 'Répétez votre email'),
            ))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('nom')
            ->add('prenom')
            ->add('datedenaissance',BirthdayType::class)
            ->add('pays')
            ->add('adresse')
            ->add('civilite',ChoiceType::class, array('choices'=>array('M'=>'gender.male','Mme'=>'gender.female'),
                'label' => 'Civilité'),array('required' => true))
            ->add('tel')
            ->add('cin')
            ->add('rib')



        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}