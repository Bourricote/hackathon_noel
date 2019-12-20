<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Entity\User;
use App\Form\MissionType;
use App\Form\SearchMissionType;
use App\Repository\MissionRepository;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mission")
 */
class MissionController extends AbstractController
{
    /**
     * @Route("/", name="mission_index", methods={"GET", "POST"})
     * @param MissionRepository $missionRepository
     * @return Response
     */
    public function index(MissionRepository $missionRepository, Request $request): Response
    {
        $form = $this->createForm(
            SearchMissionType::class
        );

        $form->handleRequest($request);
        $missions = $missionRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $missions = $missionRepository->findBySearch($data->getMissionType(), $data->getLevel(), $data->getTransport());
        }

        return $this->render('mission/index.html.twig', [
            'form' => $form->createView(),
            'missions' => $missions,
        ]);
    }

    /**
     * @Route("/enroll/{mission}/{user}", name="mission_enroll", methods={"GET"})
     * @param Mission $mission
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function enroll(Mission $mission, User $user, EntityManagerInterface $entityManager, MailerService $mailer) : Response
    {
        $user->addMission($mission);
        $entityManager->persist($user);
        $entityManager->flush();
        $from = $this->getParameter('mailer_from');
        $to = $user->getEmail();
        $subject = $this->getParameter('mailer_subject');
        $mailer->sendMissionEnrollment($from, $from, $user, $subject, $mission);

        return $this->redirectToRoute('mission_index');
    }

    /**
     * @Route("/admin/{user}", name="mission_admin", methods={"GET"})
     * @param MissionRepository $missionRepository
     * @param User $user
     * @return Response
     */

    public function adminMissions(MissionRepository $missionRepository, User $user): Response
    {
        $missions = $missionRepository->findBy(['creator' => $user->getId()]);
        return $this->render('mission/admin_index.html.twig', [
            'missions' => $missions,
        ]);
    }

    /**
     * @Route("/new", name="mission_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mission);
            $entityManager->flush();

            return $this->redirectToRoute('mission_index');
        }

        return $this->render('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mission_show", methods={"GET"})
     * @param Mission $mission
     * @return Response
     */
    public function show(Mission $mission): Response
    {
        $planet = $mission->getPlanet();

        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
            'planet' => $planet,

        ]);
    }

    /**
     * @Route("/{id}/edit", name="mission_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Mission $mission
     * @return Response
     */
    public function edit(Request $request, Mission $mission): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mission_index');
        }

        return $this->render('mission/edit.html.twig', [
            'mission' => $mission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mission_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mission $mission): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mission_index');
    }
}
