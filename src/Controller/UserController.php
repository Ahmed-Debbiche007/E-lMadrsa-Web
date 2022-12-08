<?php

namespace App\Controller;

use App\Entity\Badge;
use App\Entity\Recup;
use App\Entity\User;
use App\Entity\Participation;
use App\Form\UserType;
use App\Repository\BadgeRepository;
use App\Repository\ParticipationRepository;
use App\Repository\RecupRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/dashboard')]
class UserController extends AbstractController
{
    #[Route('/users', name: 'app_user_index', methods: ['GET'])]
    public function indexd(UserRepository $userRepository): Response
    {
        return $this->render('back_office/user/index.html.twig', [
            'users' => $userRepository->findUsers(),
            'path' => "/dashboard/new",
            'heading' => "Users"
        ]);
    }


    #[Route('/students', name: 'app_user_indexStudent', methods: ['GET'])]
    public function indexStudents(UserRepository $userRepository): Response
    {
        return $this->render('back_office/user/index.html.twig', [
            'users' => $userRepository->findStudents(),
            'path' => "/dashboard/newStudent",
            'heading' => "Students"
        ]);
    }


    #[Route('/profil', name: 'app_profil_index', methods: ['GET'])]
    public function indexe(UserRepository $userRepository): Response
    {
        return $this->render('back_office/user/showProfiles.html.twig', [
            'users' => $userRepository->findAll(),

        ]);
    }

    #[Route('/top3', name: 'app_user_top')]
    public function resultstop(UserRepository $userRepository ,ParticipationRepository $participationRepository, BadgeRepository $badgeRepository)
    {



    $participation=$participationRepository->findBySomeUser(50,$this->getUser());
    if(!is_null($participation)){
        $this->getUser()->addBadge($badgeRepository->findOneBy(['badgetype'=>'Bronze']));
        $userRepository->save($this->getUser(),true);
    }

        $participation=$participationRepository->findBySomeUser(70,$this->getUser());
        if(!is_null($participation)){
            $this->getUser()->addBadge($badgeRepository->findOneBy(['badgetype'=>'Silver']));
            $userRepository->save($this->getUser(),true);
        }
        $participation=$participationRepository->findBySomeUser(90,$this->getUser());
        if(!is_null($participation)){
            $this->getUser()->addBadge($badgeRepository->findOneBy(['badgetype'=>'Gold']));
            $userRepository->save($this->getUser(),true);
        }



         return $this->render('back_office/user/resultat.html.twig', [
            'users' => $userRepository->findAll(),
            'part' => $participationRepository->findAll(),
             'top' => $userRepository->findresultat()
        ]);
    }



    #[Route('/tutors', name: 'app_user_indexTutor', methods: ['GET'])]
    public function indexTutors(UserRepository $userRepository): Response
    {
        return $this->render('back_office/user/index.html.twig', [
            'users' => $userRepository->findTutors(),
            'path' => "/dashboard/newTutor",
            'heading' => "Tutors"
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('plainPassword')->getData()) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            }
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setImage($newFilename);
            }
            // do anything else you need here, like send an email
            $user->setApproved(1);
            $user->setRole("Admin");
            $userRepository->save($user, true);
           # $userRepository->sendsms();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'path' => "/dashboard/users",
            'heading' => "User"
        ]);
    }

    #[Route('/newStudent', name: 'app_user_newStudent', methods: ['GET', 'POST'])]
    public function newStudent(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setImage($newFilename);
            }
            // do anything else you need here, like send an email
            $user->setApproved(1);
            $user->setRole("Student");
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_indexStudent', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'path' => "/dashboard/students",
            'heading' => "Student"
        ]);
    }

    #[Route('/newTutor', name: 'app_user_newTutor', methods: ['GET', 'POST'])]
    public function newTutor(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setImage($newFilename);
            }
            // do anything else you need here, like send an email
            $user->setApproved(1);
            $user->setRole("Tutor");
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_indexTutor', [], Response::HTTP_SEE_OTHER);
        }



        return $this->renderForm('back_office/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'path' => "/dashboard/tutors",
            'heading' => "Tutor"

        ]);
    }


    #[Route('/forgetPassword', name: 'app_forget_password', methods: ['GET', 'POST'])]
    public function forgetPassword(): Response
    {
        return $this->render('security/forgetPassword.html.twig');
    }

    #[Route('/sendForget', name: 'app_send_forget')]
    public function sendForget(Request $request, RecupRepository $repo, UserRepository $userRepository): Response
    {
        if($request->request->get('email') !=null){

            $userMail = $request->request->get('email');
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 15; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $user = $userRepository->findOneBy(['email' => $userMail]);
            $code = new Recup();
            $code->setCode($randomString);
            $code->setIduser($user->getId());
            $repo->save($code, true);

            $mailer = new SendMailController();
            $email = (new Email())
                ->from('springforfever@gmail.com')
                ->to($userMail)
                ->subject('Password Recovery')
                ->text('This code will recover your email: ' . $randomString);
            $mailer->send($email);
        }

        if($request->request->get('code') !=null){
            $code = $request->request->get('code');
            $recup = $repo->findOneBy(['code'=> $code]);
            $user = $userRepository->findOneBy(['id'=>$recup->getIduser()]);
            dd($user);
        }
        return $this->render('/security/code.html.twig');
    }



    #[Route('/verify', name: 'app_verify', methods: ['GET', 'POST'])]
    public function verify(Request $request, RecupRepository $repo, UserRepository $userRepository): Response
    {
        if($request->request->get('code') !=null) {
            $code = $request->request->get('code');
            $recup = $repo->findOneBy(['code' => $code]);
            $user = $userRepository->findOneBy(['id' => $recup->getIduser()]);

        }
        return $this->render('/security/changePassword.html.twig', [
            "user" => $user
        ]);
    }


    #[Route('/change', name: 'app_change', methods: ['GET', 'POST'])]
    public function change(Request $request, RecupRepository $repo, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {

        $user = $userRepository->findOneBy(["id"=>$request->request->get("user")]);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $request->request->get("password")
            )
        );
        $userRepository->save($user,true);
        return $this->redirectToRoute('app_login');
    }


/*
    #[Route('/{id}', name: 'app_badge_show', methods: ['GET'])]
    public function showw(Badge $badge): Response
    {
        return $this->render('back_office/user/show.html.twig', [
            'badge' => $badge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_badge_edit', methods: ['GET', 'POST'])]
    public function editt(Request $request, Badge $badge, BadgeRepository $badgeRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(UserType::class, $badge);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $pass = $form->get('plainPassword')->getData();
            if ($pass != "") {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            }
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setImage($newFilename);
            }
            $badgeRepository->save($badge, true);

            return $this->redirectToRoute('app_badge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/user/edit.html.twig', [
            'badge' => $badge,
            'form' => $form,
            'heading' => $user->getRole()
        ]);
    }

    #[Route('/{id}', name: 'app_badge_delete', methods: ['POST'])]
    public function deletee(Request $request, Badge $badge, BadgeRepository $badgeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $badge->getId(), $request->request->get('_token'))) {
            $badgeRepository->remove($badge, true);
        }

        return $this->redirectToRoute('app_badge_index', [], Response::HTTP_SEE_OTHER);
    }
*/

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('back_office/user/show.html.twig', ['user' => $user]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $pass = $form->get('plainPassword')->getData();
            if ($pass != "") {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            }
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setImage($newFilename);
            }
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'heading' => $user->getRole()
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }





}
