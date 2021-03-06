<?php

namespace DL\UserBundle\Controller;


use DL\UserBundle\Entity\Mlm;
use DL\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;


class RegistrationController extends Controller
{

    public function editAction(Request $request, User $user,Request $request, $id)
    {
        $mlm = new Mlm();
        $mlm1= new Mlm();
        $utilisateur = new User();

        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('DL\UserBundle\Form\register1Type', $user);
        $editForm->handleRequest($request);


        $user = $em->getRepository('DLUserBundle:User')->find($id);


        if (!$user->getemailenrolleur() || !$user->getemaildirect()){

            return $this->redirectToRoute('erreurAddfile');

        }

        $enrolleur=$em->getRepository('DLUserBundle:User')->findOneBy(array('email'=>$user->getEmailenrolleur()));
        $direct = $em->getRepository('DLUserBundle:User')->findOneBy(array('email'=>$user->getEmaildirect()));

        if (!$enrolleur || !$direct)
        {
            return $this->redirectToRoute('erreurAddfile');
        }


        $utilisateur = $em->getRepository('DLUserBundle:User')->findOneBy(array('id'=>$user->getId()));
        $code = $utilisateur->getCode();
        //$codeparent = $mlm1->getCodeparent();

        //$userparent= $em->getRepository('DLUserBundle:User')->findOneBy(array('code'=>$codeparent));
        $idparent = $enrolleur->getId();

        //objet mlm à remplir avec le code du nouv partenaire
        $mlm1 = $em->getRepository('DLUserBundle:Mlm')->findOneBy(array('idpartenaire'=>$idparent));




        if ($editForm->isSubmitted() && $editForm->isValid()) {


            $this->getDoctrine()->getManager()->flush();



            $normalizer = new DataUriNormalizer();

            $getrib= $user->getRibDocument();
            $rib = $normalizer->normalize(new \SplFileObject($user->getRibDocument()));

            $getcin= $user->getCinDocument();
            $cin = $normalizer->normalize(new \SplFileObject($user->getCinDocument()));

            $user->setCinDocument($cin);
            $user->setRibDocument($rib);



            $mlm->setIdpartenaire($user->getId());
            $mlm -> setCodeparent($enrolleur->getCode());
            $mlm->setCodedirect($direct->getCode());

            if ($mlm1->getCodegauche()== NULL ) {
                $mlm1->setCodegauche($code);
            }
            else {
                $mlm1->setCodedroite($code);
            }
            $em->persist($user);
            $em->persist($mlm1);
            $em->persist($mlm);
            $em->flush();




            return $this->redirectToRoute('dashboard', array('id' => $user->getId()));
        }

        return $this->render('@DLUser/Registration/register1.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('register1', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function erreurAddFileAction()
    {
        // replace this example code with whatever you need
        return $this->render('@DLUser/Registration/erreurAddFiles.html.twig');
    }








}
