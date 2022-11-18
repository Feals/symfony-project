<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Form\CategoryType;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;


#[Route('/category', name: 'category_')]
Class CategoryController extends AbstractController

{

    #[Route('/', name: 'index')]

    public function index(CategoryRepository $categoryRepository): Response

    {
        $categories = $categoryRepository->findAll();       

        return $this->render('category/index.html.twig', [

            'categories' => $categories
     
         ]);
    }

    #[Route('/new', name: 'new')]

    public function new(Request $request, CategoryRepository $categoryRepository ): Response

    {
        $category = new Category();
        // Create the form, linked with $category
        $form = $this->createForm(CategoryType::class, $category);
     // Get data from HTTP request

     $form->handleRequest($request);

     // Was the form submitted ?
 
     if ($form->isSubmitted()) {
        $categoryRepository->save($category, true);
        return $this->redirectToRoute('category_index');
 
         // Deal with the submitted data
 
         // For example : persiste & flush the entity
 
         // And redirect to a route that display the result
 
     }
 
 
     // Render the form
 
     return $this->renderForm('category/new.html.twig', [
 
         'form' => $form,

    ]);
    }

    #[Route('/{categoryName}', name: 'show')]

public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository):Response
        
{   $category = $categoryRepository->findBy(['name' => $categoryName]); 
    
    
    if (!$category) {

        throw $this->createNotFoundException(

            "Il n'existe pas de catégorie " . $categoryName . "."

        );

    }     
    
    $categoryId = $category[0]->getId();
    $programs = $programRepository->findBy(['category' => $categoryId], ['id' => 'DESC'], 3 );
    
    // same as $program = $programRepository->find($id);
    $category = $category[0];

    if (!$programs) {

        throw $this->createNotFoundException(

            'Pas de Série trouvé dans la catégorie ' . $categoryName . "."

        );

    }

    return $this->render('category/show.html.twig', [
        'category' => $category,
        'programs' => $programs

    ]);

}



}