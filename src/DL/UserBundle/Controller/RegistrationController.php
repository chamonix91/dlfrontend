<?php

namespace DL\UserBundle\Controller;


use DL\UserBundle\Entity\Mlm;
use DL\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;


class RegistrationController extends Controller
{

    public function editAction(Request $request, User $user)
    {
        $mlm = new Mlm();
        $mlm1= new Mlm();
        $utilisateur = new User();

        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('DL\UserBundle\Form\register1Type', $user);
        $editForm->handleRequest($request);



        $enrolleur=$em->getRepository('DLUserBundle:User')->findOneBy(array('email'=>$this->getUser()->getemailenrolleur()));
        $direct = $em->getRepository('DLUserBundle:User')->findOneBy(array('email'=>$this->getUser()->getemaildirect()));

        $utilisateur = $em->getRepository('DLUserBundle:User')->findOneBy(array('id'=>$this->getUser()->getId()));
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
            $rib = $normalizer->normalize(new \SplFileObject($getrib));

            $getcin= $user->getRibDocument();
            $cin = $normalizer->normalize(new \SplFileObject($getcin));
            $user->setCinDocument($cin);



            $mlm->setIdpartenaire($this->getUser()->getId());
            $mlm -> setCodeparent($enrolleur->getCode());
            $mlm->setCodedirect($direct->getCode());

            if ($mlm1->getCodegauche()== "") {
                $mlm1->setCodegauche($code);
            }
            else {
                $mlm1->setCodedroite($code);
            }
            $em->persist($mlm1);
            $em->persist($mlm);
            $em->flush();



            return $this->redirectToRoute('register1', array('id' => $user->getId()));
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
}
