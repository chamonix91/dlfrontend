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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use DL\UserBundle\Form\MlmType;
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder

            ->add('emailenrolleur',EmailType::class, array('label' => 'Email upline', 'required' => true))
            ->add('emaildirect',EmailType::class, array('label' => 'Email parrain', 'required' => true))
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
            ->add('nom',TextType::class, array('label' => 'Nom', 'required' => true))
            ->add('prenom',TextType::class, array('label' => 'Prenom', 'required' => true))
            ->add('datedenaissance',BirthdayType::class)
            ->add('pays')
            ->add('adresse',TextType::class, array('label' => 'Adresse', 'required' => true))
            ->add('civilite',ChoiceType::class, array('choices'=>array('M'=>'gender.male','Mme'=>'gender.female'),
                'label' => 'Civilité'),array('required' => true))
            ->add('tel',TextType::class, array('label' => 'Téléphone', 'required' => true))
            ->add('pack')
            ->add('cin')
            ->add('rib')
            ->add('ribDocument', FileType::class,  array('data_class' => null,'label' => 'Votre Justificatif de paiement:    '))
            ->add('cinDocument', FileType::class, array('data_class' => null,'label' => 'Votre CIN  :   '))



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