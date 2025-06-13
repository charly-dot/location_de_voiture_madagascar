<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeForm;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UtilisateurController extends AbstractController
{
    

    #[Route('/insertionVehicule', name: 'Vehicule')]
    public function insertionVehicule(Request $request, EntityManagerInterface $em, VehiculeRepository $donnes): Response
    {
        $this -> denyAccessUnlessGranted('ROLE_USER');
        $donne = new Vehicule;
        $formulaire = $this -> createForm(VehiculeForm::class, $donne);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $images = ['image', 'image2', 'image3', 'image4'];
            foreach ($images as $imageField) {
                $file = $formulaire->get($imageField)->getData();
        
                if ($file) {
                    $fileName = uniqid() . '.' . $file->guessExtension();
                    $file->move(
                        $this->getParameter('kernel.project_dir') . '/public/image',
                        $fileName
                    );
                    $setter = 'set' . ucfirst($imageField);
                    if (method_exists($donne, $setter)) {
                        $donne->$setter($fileName);
                    }
                }
            }
            $em->persist($donne);
            $em->flush();
        
            $donne = $donnes->findAll();
            return $this->render('controllers/index.html.twig', [
                'donne' => $donne
            ]);
        }
        return $this->render('insertion/insertionVehicule.html.twig', [
            'form' => $formulaire
        ]);
    }
}
