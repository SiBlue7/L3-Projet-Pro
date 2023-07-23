<?php

namespace App\Controller;

use App\Entity\Exercices;
use App\Entity\Historique;
use App\Entity\LanguageCategory;
use App\Entity\ThematiqueCategory;
use App\Entity\User;
use App\Repository\ExercicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\DateTime;

class PageExerciceController extends AbstractController
{
    /**
     * @Route("/page/exercice", name="app_page_exercice")
     */

    public function index(Request $request, ExercicesRepository $exerciceRepository)
    {
        $languageCategory = $request->request->get('languageCategory');
        $thematiqueCategory = $request->request->get('thematiqueCategory');

        $exercices = $exerciceRepository->createQueryBuilder('e')
            ->leftJoin('e.languageCategories', 'lc')
            ->leftJoin('e.thematiqueCategories', 'tc');

        if ($languageCategory && $thematiqueCategory) {
            $exercices->where('lc.id = :languageCategory')
                ->andWhere('tc.id = :thematiqueCategory')
                ->setParameters(['languageCategory' => $languageCategory, 'thematiqueCategory' => $thematiqueCategory]);
        } elseif ($languageCategory) {
            $exercices->where('lc.id = :languageCategory')
                ->setParameter('languageCategory', $languageCategory);
        } elseif ($thematiqueCategory) {
            $exercices->where('tc.id = :thematiqueCategory')
                ->setParameter('thematiqueCategory', $thematiqueCategory);
        }

        $exercices = $exercices->getQuery()->getResult();

        $languageCategories = $this->getDoctrine()->getRepository(LanguageCategory::class)->findAll();
        $thematiqueCategories = $this->getDoctrine()->getRepository(ThematiqueCategory::class)->findAll();

        return $this->render('page_exercice/index.html.twig', [
            'exercices' => $exercices,
            'languageCategories' => $languageCategories,
            'thematiqueCategories' => $thematiqueCategories,
        ]);
    }

    /**
     * @Route("/page/exercice/{id}", name="app_exercice_show")
     */
    public function show(Request $request, EntityManagerInterface $entityManager, Exercices $exercice, Security $security): Response
    {

        //Envoie en bdd des sauvegardes de l'utilisateur
        $user = $security->getUser();
        $User_id = $user ? $user->getId() : null;
        $Exo_id = $exercice->getId();

        if (isset($_POST['envoi-code'])) {
            $nom = $_POST['nom-save'];
            $date = new \DateTime();
            $dateStr = $date->format('Y-m-d H:i:s');
            $code = $request->request->get('RecupCode');

            if (!$nom) {
                $nom = $dateStr;
            }

            if (!$code) {
                $code = $nom;
            }

            $historique = new Historique();
            $historique->setName($nom);
            $historique->setCreatedAt($date);
            $historique->setCode($code);
            $historique->setExoId($Exo_id);
            $historique->setUserId($User_id);

            $entityManager->persist($historique);
            $entityManager->flush();
        }


        $historiqueRepository = $this->getDoctrine()->getRepository(Historique::class);
        $lastHistorique = $historiqueRepository->createQueryBuilder('h')
            ->where('h.Exo_id = :exoId')
            ->andWhere('h.User_id = :userId')
            ->setParameter('exoId', $exercice->getId())
            ->setParameter('userId', $user->getId())
            ->orderBy('h.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();


        // Récupération de tous les historiques pour l'exercice actuel et l'utilisateur
        $historiques = $historiqueRepository->createQueryBuilder('h')
            ->where('h.Exo_id = :exoId')
            ->andWhere('h.User_id = :userId')
            ->setParameter('exoId', $exercice->getId())
            ->setParameter('userId', $user->getId())
            ->orderBy('h.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        // Création d'un tableau des versions d'historique pour le select
        $versions = [];
        foreach ($historiques as $historique) {
            $versions[$historique->getId()] = $historique->getName();
        }

        return $this->render('page_exercice/show.html.twig', [
            'exercice' => $exercice,
            'lastHistorique' => $lastHistorique,
            'historiques' => $historiques
        ]);
    }
}
