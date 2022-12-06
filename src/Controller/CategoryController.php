<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Category;
use App\Form\CategoriersearchType;
use App\Form\CategoryType;

use App\Quote\Quote;

use App\Repository\CategorieRepository;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping\PostRemove;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;

#[Route('dashboard/category')]
class CategoryController extends AbstractController
{
    private $postrepo ;
    private $qouteService;

    public function __construct(PostRepository $postrepo,Quote $quoteService){
        $this->postrepo = $postrepo;
        $this->qouteService = $quoteService;

    }

    #[Route('/', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('back_office/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }



    #[Route('/list/front', name: 'app_category_frontlist', methods: ['GET'])]
    public function indexfront(CategoryRepository $categoryRepository): Response
    {
        return $this->render('front_office/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }


    // ena ameltha : gouiaa
    #[Route('/search', name: 'app_category_new_searching', methods: ['GET' ])]
    public function searchcat(Request $request, CategorieRepository $categoryRepository, SluggerInterface $slugger): Response
    {
        $category = new Categorie();
        $categories = $categoryRepository->findAll();
        $form = $this->createForm(CategoriersearchType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('front_office/exams/searchcategorieform.html.twig' );
        }

        return $this->renderForm('front_office/exams/searchcategorieform.html.twig', [
            'category' => $category,
            'form' => $form,
            'categories'=>$categories
        ]);
    }

    #[Route('/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoryRepository $categoryRepository, SluggerInterface $slugger): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('categoryimage')->getData();
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
                $category->setCategoryimage($newFilename);
            }
            $categoryRepository->save($category, true);
            /****alert****/

            $this->addFlash('info', 'added successfully');

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }


    #[Route('/{categoryid}', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        $posts = $this->postrepo->findBy(["category" => $category->getCategoryid()]);
        return $this->render('back_office/category/show.html.twig', [
            'category' => $category,
            'posts' => $posts
        ]);
    }
    #[Route('/front/show/{categoryid}', name: 'app_category_showfront', methods: ['GET'])]
    public function showfront(Category $category,PaginatorInterface $paginator,Request $request): Response
    {
        $HallOfFame=$this->postrepo->mostlikedusers();
        $posts = $this->postrepo->findBy(["category" => $category->getCategoryid()]);
        $posts = $paginator->paginate(
            $posts, /* query NOT result */
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('front_office/category/show.html.twig', [
            'category' => $category,
            'posts' => $posts,
            'top'=>$HallOfFame,
            'quote'=>$this->qouteService->getQuote()
        ]);
    }
    #[Route('/{categoryid}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, CategoryRepository $categoryRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('categoryimage')->getData();
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
                $category->setCategoryimage($newFilename);
            }
            $categoryRepository->save($category, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{categoryid}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getCategoryid(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }




/*
    #[Route('/search', name: 'app_category_search', methods: ['GET', 'POST'])]
    public function search(Request $request, CategoryRepository $categoryRepository, SluggerInterface $slugger): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoriersearchType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/category/.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }
*/





}
