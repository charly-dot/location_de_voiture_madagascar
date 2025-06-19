<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Commandes;
use App\Entity\Discution;
use App\Entity\Proprietaire;
use App\Entity\Tomobiles;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Form\CommandeForm;
use App\Form\CommandesForm;
use App\Form\DiscutionForm;
use App\Form\DiscutionsForm;
use App\Form\ProprietaireForm;
use App\Form\TomobileForm;
use App\Form\TomobilesForm;
use App\Form\VehiculeForm;
use App\Form\VehiculesForm;
use App\Repository\CommandeRepository;
use App\Repository\CommandesRepository;
use App\Repository\DiscutionRepository;
use App\Repository\ProprietaireRepository;
use App\Repository\TomobilesRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\File;
final class ControllersController extends AbstractController
{
    #[Route('/', name: 'app_controlls')]
    public function index(TomobilesRepository $donnes): Response
    {
        $donne = $donnes->findAll();
        $type = $donnes->ConditionType();
        $cate = $donnes->Conditioncates();
        $categorie = $donnes->ConditionCategorie();
    
        // dd($categorie);
        return $this->render('controllers/index.html.twig', [
            'donne' => $donne,
            'cate' => $cate,
            'categorie' => $categorie,
            'type' => $type
        ]);
    }
    


    #[Route('/pageFiltre/{filter}/{id}', name: 'app_controlle')]
    public function filtre(TomobilesRepository $donnes, Request $request, string $filter, int $id): Response
    {
        $donne = 0;

        if($id == 1){
            $donne = $donnes->ConditionVehiculeFilterType($filter);
        }else if ($id == 2){
            $donne = $donnes->ConditionVehiculeFilterCategorie($filter);
        }else{
            $donne = $donnes->ConditionVehiculeFilterPrix($filter);
        }
        $type = $donnes->ConditionType();
        $cate = $donnes->Conditioncates();
        $categorie = $donnes->ConditionCategorie();
       
        return $this->render('controllers/index.html.twig', [
            'donne' => $donne,
            'cate' => $cate,
            'categorie' => $categorie,
            'type' => $type
        ]);
   
    }

    #[Route('/pageDetail/{id}', name: 'pageDetail')]
    public function details(TomobilesRepository  $donnes2, int $id, Request $request, EntityManagerInterface $em): Response
    {
        $insertionCommenter = new Discution();
        $donne2 = $donnes2->find($id);
        
        $insertion = new Commandes();
        $insertion->setIdVehicule($donne2->getId()); 
        $insertion->setConfirmer('vue'); 

        $formCommenter = $this -> createForm(DiscutionForm::class);
        $formCommenter->handleRequest($request);

        $form = $this -> createForm(CommandesForm::class, $insertion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('lancer')->isClicked()) {
                    $em->persist($insertion);
                    $em->flush();
                    $this->addFlash('success', 'le commande ete bien envoyer, attende le repense sur votre email');
                    return $this->render('controllers/details.html.twig', [
                        'donne2' => $donne2,
                        'form' => $form,
                        'formCommenter' => $formCommenter,
                    ]);
            }
        }
            if ($formCommenter->isSubmitted() && $formCommenter->isValid()) {
                if ($formCommenter->get('envoye')->isClicked()) {
                    
                    $insertionCommenter->setEmail($formCommenter->get('email')->getData());
                    $insertionCommenter->setContact($formCommenter->get('contact')->getData());
                    $insertionCommenter->setDiscution($formCommenter->get('discution')->getData());

                    $insertionCommenter->setIdVehicule(2);
                    $insertionCommenter->setConfirmation('En attente');
                    $em->persist($insertionCommenter);
                    $em->flush();
                    $this->addFlash('success', 'votre commentaire ete bien envoyer, attende le repense sur votre email');
                    return $this->render('controllers/details.html.twig', [
                        'donne2' => $donne2,
                        'form' => $form,
                        'formCommenter' => $formCommenter,
                    ]);
                }
            }


        return $this->render('controllers/details.html.twig', [
            'donne2' => $donne2,
            'form' => $form,
            'formCommenter' => $formCommenter,
        ]);
    }


    #[Route('/admin', name: 'admin')]
    public function administration(CommandesRepository $vue,TomobilesRepository $donne): Response
    {
        $this -> denyAccessUnlessGranted('ROLE_USER');
        $donne2 = $donne->findAll();
        $vue = $vue->vue();
        return $this->render('controllers/Container/admin.html.twig', [
            'donne' => $donne2,        
            'condition' => 'Vehic',
            'indice' => ' ',
            'vue' => $vue,
        ]);
    }
    #[Route('/commentaires', name: 'commentaire')]
    public function comment(DiscutionRepository $vueRepo, TomobilesRepository $donneRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $donneesVehicules = $donneRepo->findAll(); // véhicules
        $discutions = $vueRepo->findAll(); // discussions
    
        return $this->render('controllers/Container/admin.html.twig', [
            'donne' => $donneesVehicules,
            'condition' => 'discution',
            'indice' => ' ',
            'vue' => $discutions,
        ]);
    }
    
    
    #[Route('/commandes', name: 'commande')]
    public function commandess(CommandesRepository $donne, TomobilesRepository $donnes): Response
    {
        $this -> denyAccessUnlessGranted('ROLE_USER');
        $donne2 = $donne->findAll();
        $xxx = $donne->totalConfirme();
        $confirme = $donne->totalxxx();
        $vue = $donne->vue();
        
        
        // dd($donne5 .'' . $donne4);
        return $this->render('controllers/Container/admin.html.twig', [
            'donne' => $donne2,       
            'condition' => 'commande',
            'indice' => ' ',
            'vue' => $vue,
        ]);
    }

    #[Route('/administrationProprietaire', name: 'admiP')]
    public function admiPropri(ProprietaireRepository $donne, CommandesRepository $donnes): Response
    {
        $this -> denyAccessUnlessGranted('ROLE_USER');
        $donne2 = $donne->findAll();
        $vue = $donnes->vue();
        return $this->render('controllers/Container/admin.html.twig', [
            'donne' => $donne2,        
            'condition' => 'Vehic',
            'indice' => 'proprietaire',
            'vue' => $vue,
        ]);
    }   

    #[Route('/insertionVehicule', name: 'Vehicule')]    
    public function insertionVehicule(Request $request, EntityManagerInterface $em, TomobilesRepository $donnes, ProprietaireRepository $proprietaire): Response
    {
        // $id_entrange = $proprietaire -> findOneBy(['name' => 'charly']);
        // $this -> denyAccessUnlessGranted('ROLE_USER');
        // $donne = new Tomobiles();
        // $formulaire = $this -> createForm(TomobilesForm::class, $donne);
        // $formulaire->handleRequest($request);

        // if ($formulaire->isSubmitted() && $formulaire->isValid()) {
        //     $images = ['image', 'image2', 'image3', 'image4'];
        //     foreach ($images as $imageField) {
        //         $file = $formulaire->get($imageField)->getData();
        
        //         if ($file) {
        //             $fileName = uniqid() . '.' . $file->guessExtension();
        //             $file->move(
        //                 $this->getParameter('kernel.project_dir') . '/public/image',
        //                 $fileName
        //             );
        //             $setter = 'set' . ucfirst($imageField);
        //             if (method_exists($donne, $setter)) {
        //                 $donne->$setter($fileName);
        //             }
        //         }
        //     }
        //     $em->persist($donne);
        //     $em->flush();
        
        //     $donne = $donnes->findAll();
        //     $proprietaire = $proprietaire->findAll();
        //     return $this->render('controllers/index.html.twig', [
        //         'donne' => $donne,
        //         'proprietaire' => $proprietaire,

        //     ]);
        // }
        // return $this->render('insertion/insertionVehicule.html.twig', [
        //     'form' => $formulaire
        // ]);
        dd('sfq');

    }

    #[Route('/insertionClient/{act}/{id}', name: 'insertionClients')]
    public function insertionClient(int $id,int $act,Request $request, EntityManagerInterface $em,TomobilesRepository $donne, ProprietaireRepository $pro, CommandesRepository $donnes): Response
    {
        $donneBase = new Proprietaire();
        $form = $this -> createForm(ProprietaireForm::class, $donneBase);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $em->persist($donneBase);
            $em->flush();
            $vue = $donnes->vue();
            $donne2 = $donne->findAll();
            // dd($donne2);
            $this->addFlash('success', 'le utilisatereur est bien enregistre');
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,        
                'condition' => 'proprietaire',
                'indice' => ' ',
                'vue' => $vue,
            ]);
        }
        return $this->render('insertion/insertionClient.html.twig', [
            'form' => $form->createView()
        ]);
    }   

    #[Route('/ModifierClients/{act}/{id}', name: 'ModifClient')]
    public function ModifierClient(int $id,int $act,Request $request, EntityManagerInterface $em,TomobilesRepository $donne, ProprietaireRepository $pro, CommandesRepository $donnes): Response
    {
        $donneBase =  $pro->find(['id'=>$id]);
        $form = $this -> createForm(ProprietaireForm::class, $donneBase);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($donneBase);
            $em->flush();
            $donne2 = $pro->findAll();
            
            $vue = $donnes->vue();
            // dd($vue);
            $this->addFlash('success', 'le utilisatereur est bien modifier');
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,        
                'condition' => 'Vehic',
                'indice' => 'proprietaire',
                'vue' => $vue,
            ]);
        }
        return $this->render('insertion/insertionClient.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/actions/{act}/{id}', name: 'actions')]
    public function Action(CommandesRepository $vue, ProprietaireRepository $proprietaire ,TomobilesRepository $donnes, Request $request, string $act, int $id, EntityManagerInterface $em, CommandesRepository $donneCommandes): Response
    {
        $donne = $act;
        $this -> denyAccessUnlessGranted('ROLE_USER');

        if($id == 2){

            $sd = 1;
            $donnes = $proprietaire ->find(['id'=>2]);
            $vue = $donneCommandes->vue();
            
            return $this -> render('controllers/Container/admin.html.twig', [
                'donne' => $donnes,
                'condition' => 'Prop',
                'indice' => ' ',
                'vue' => $vue,
             ]);

        }else if ($id == 1){

            $donne = $donnes->find($act);
            // $insertionCommenter->setEmail($formCommenter->get('email')->getData());
            $formulaire = $this->createForm(TomobileForm::class, $donne);
            $formulaire->handleRequest($request);
    
            if ($formulaire->isSubmitted() && $formulaire->isValid()) {
                $images = ['image', 'image2', 'image3', 'image4'];
                foreach ($images as $imageField) {
                    $file = $formulaire->get($imageField)->getData();
                    
                    if ($file) {
                        $fileName = uniqid() . '.' . $file->guessExtension();
                        $file->move(
                            $this->getParameter('kernel.project_dir') . '/public/image/',
                            $fileName
                        );
                        
                        $setter = 'set' . ucfirst($imageField);
                        if (method_exists($donne, $setter)) {
                            $donne->$setter($fileName); // Enregistre juste le nom dans l'objet
                        }
                    }
                }
            
                $em->persist($donne);
                $em->flush();
            
                $donne = $donnes->findAll();
                $proprietaire = $proprietaire->findAll();
                return $this->render('controllers/index.html.twig', [
                    'donne' => $donne,
                    'proprietaire' => $proprietaire,
    
                ]);
            }
                return $this->render('insertion/insertionVehicule.html.twig', [
                    'form' => $formulaire
                ]);

        }else if($id == 3){

            $donne = $donnes->find($act);
            $em->remove($donne);
            $em->flush();
            $donne2 = $donnes->findAll();
            $vue = $donneCommandes->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,
                'condition' => 'Vehic',
                'indice' => ' ',
                'vue' => $vue,
            ]);
            
        }else if($id == 4){

            $donne = $donneCommandes->find($act);
            $em->remove($donne);
            $em->flush();
            $donne2 = $donneCommandes->findAll();
            $vue = $donneCommandes->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,
                'condition' => 'commande',
                'indice' => ' ',
                'vue' => $vue,
            ]);
            // dd('4');
            
        }else if($id == 5){

            // $insertion = $donneCommandes->find($act);
            // $insertion->setConfirmer('confirmer');
            // $em->flush();
            // $this->addFlash('success', 'le vehicule est bien rèserve');
            // $donne2 = $donneCommandes->findAll();
            // $vue = $donneCommandes->vue();
            // return $this->render('controllers/Container/admin.html.twig', [
            //     'donne' => $donne2,
            //     'condition' => 'commande',
            //     'indice' => ' ',
            //     'vue' => $vue,
            // ]);
            $donne2 = $donnes->vehiculePro($act);
            // dd($donne2);
            $vue = $vue->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,        
                'condition' => 'Vehic',
                'indice' => ' ',
                'vue' => $vue,
            ]);
            
            
        }else if($id == 6){
            $donne = $proprietaire->find($act);
            $em->remove($donne);
            $em->flush();
            $this->addFlash('success', 'le client ete bien supprimer');
            $donne2 = $proprietaire->findAll();

            $vue = $donneCommandes->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,
                'condition' => 'Vehic',
                'indice' => 'proprietaire',
                'vue' => $vue,
            ]);
            
        }else if($id == 8){
            
                $lsf = $donneCommandes->commandeConditionVehicule($act);
                foreach ($lsf as $commande) {
                    $commande->setConfirmer('xxx');
                }

                $insertion = $donnes->find($act);
                $insertion->setReservation('xxx');

                $em->flush();
                $this->addFlash('success', 'le vehicule est bien dèserve');
                $donne2 = $donneCommandes->findAll();

                $vue = $donneCommandes->vue();
                $donne2 = $donnes->findAll();
                $vue = $donneCommandes->vue();
                return $this->render('controllers/Container/admin.html.twig', [
                    'donne' => $donne2,        
                    'condition' => 'Vehic',
                    'indice' => ' ',
                    'vue' => $vue,
                ]);
                
        }else if($id == 9){
            $lsf = $donneCommandes->commandeConditionVehicule($act);
            foreach ($lsf as $commande) {
                $commande->setConfirmer('reserver');
            }

            $insertion = $donnes->find($act);
            $insertion->setReservation('reserver');
            $em->flush();
            $this->addFlash('success', 'le vehicule est bien dèserve');
            $donne2 = $donneCommandes->findAll();

            $vue = $donneCommandes->vue();
            $donne2 = $donnes->findAll();
            $vue = $donneCommandes->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,        
                'condition' => 'Vehic',
                'indice' => ' ',
                'vue' => $vue,
            ]);
            
        }else {
            
        }


        return new Response(' ');
    }

    
    #[Route('/nouveau', name: 'insertion_tomobiles')]    
    public function insertion_tomobile(Request $request, EntityManagerInterface $em, VehiculeRepository $donnes, ProprietaireRepository $proprietaire, CommandesRepository $vue,TomobilesRepository $donness): Response
    {
        // $id_entrange = $proprietaire -> findOneBy(['name' => 'charly']);
        // $this -> denyAccessUnlessGranted('ROLE_USER');
        $donne = new Tomobiles();
        $formulaire = $this -> createForm(TomobileForm::class, $donne);
        
        
        $donne->setReservation('xxx');
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
            $proprietaire = $proprietaire->findAll();
            $donne2 = $donness->findAll();
            $vue = $vue->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,        
                'condition' => 'Vehic',
                'indice' => ' ',
                'vue' => $vue,
            ]);
        }
            return $this->render('insertion/insertionVehicule.html.twig', [
                'form' => $formulaire
            ]);
        // dd('sfq');
        // return new Response('qsdf');

    }

    #[Route('/actionvehicule/{act}/{act1}/{id}', name: 'actionsVehi')]
    public function ActionVehicules(CommandesRepository $vue, ProprietaireRepository $proprietaire ,TomobilesRepository $donnes, Request $request, string $act, string $act1,int $id, EntityManagerInterface $em, CommandesRepository $donneCommandes): Response
    {
        $donne = $act;
        $this -> denyAccessUnlessGranted('ROLE_USER');

        if($id == 10){
            $insertionvoiture = $donnes->find($act1);              // <- 1ère entité (ex: Tomobiles)
            if ($insertionvoiture) {
                $insertionvoiture->setReservation('reserver');
            } else {
                throw $this->createNotFoundException('Véhicule introuvable avec ID : ' . $act);
            }
            
            $insertioncommande = $donneCommandes->find($act); // Rechercher la commande
            if ($insertioncommande) {
                $insertioncommande->setConfirmer('reserver');
            } else {
                throw $this->createNotFoundException('Commande introuvable avec ID : ' . $act);
            }        
           

            $em->flush();
            $this->addFlash('success', 'le vehicule est bien rèserve');
            $donne2 = $donneCommandes->findAll();
            $vue = $donneCommandes->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,
                'condition' => 'commande',
                'indice' => ' ',
                'vue' => $vue,
            ]);
       
            
        }else if($id == 7){
            $insertionvoiture = $donnes->find($act1);
            if ($insertionvoiture) {
                $insertionvoiture->setReservation('xxx');
            } else {
                throw $this->createNotFoundException('Véhicule introuvable avec ID : ' . $act);
            }
            $insertioncommande = $donneCommandes->find($act);
            if ($insertioncommande) {
                $insertioncommande->setConfirmer('xxx');
            } else {
                throw $this->createNotFoundException('Commande introuvable avec ID : ' . $act);
            }        
            $em->flush();
            $this->addFlash('success', 'le vehicule est bien rèserve');
            $donne2 = $donneCommandes->findAll();
            $vue = $donneCommandes->vue();
            return $this->render('controllers/Container/admin.html.twig', [
                'donne' => $donne2,
                'condition' => 'commande',
                'indice' => ' ',
                'vue' => $vue,
            ]);
        }else {
        }
        return new Response(' ');
    }
}
