<?php

namespace App\Controller;

use App\Entity\Events;
use App\Repository\EventsRepository;
use App\Form\EventsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    #[Route('/events', name: 'events_index')]
    public function index(EventsRepository $eventsRepository): Response
    {

        $events = $eventsRepository->findAll([]);
        return $this->render('events/index.html.twig', [
            'controller_name' => 'EventsController',
            'events' => $events
        ]);
    }
    #[Route('/events/new', name: 'events_new')]
    public function newEvent(Request $request, EntityManagerInterface $manager): Response
    {

        $event = new Events();
        $form = $this->createForm(EventsType::class,$event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($event);
            $manager->flush();

            $this->addFlash('event_new_success','Votre Évènement à bien été crée');
           return $this->redirectToRoute('events_index',[], Response::HTTP_SEE_OTHER);

        }

            return $this->render('events/new.html.twig', [
            'controller_name' => 'EventsController',
            'form'=> $form->createView()
        ]);
    }
    #[Route('/events/delete/{id}', name: 'events_delete')]
    public function deleteEvent(EventsRepository $eventsRepository, Request $request, EntityManagerInterface $manager): Response
    {

            $event_id = $request->attributes->get('id');
            $event = $eventsRepository->find($event_id);

            $manager->remove($event);
            $manager->flush();

            $message = 'Votre Événement: [' . $event->getName() . '] à bien été supprimé';

        $this->addFlash('event_delete_success',$message );

        return $this->redirectToRoute('events_index',[], Response::HTTP_SEE_OTHER);

    }
    #[Route('/events/update', name: 'events_update')]
    public function updateEvent(EventsRepository $eventsRepository): Response
    {

        $events = $eventsRepository->findAll();

        return $this->render('events/index.html.twig', [
            'controller_name' => 'EventsController',
            'events' => $events
        ]);
    }
}
