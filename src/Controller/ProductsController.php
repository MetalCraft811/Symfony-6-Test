<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductFormType;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends AbstractController
{
    private $em;
    private $productRep;
    public function __construct(EntityManagerInterface $em, ProductsRepository $productRep) 
    {
        $this->em = $em;
        $this->productRep = $productRep;
    }

    #[Route('/products', name: 'products')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Products::class);
        $products = $repository->findAll();
        $mp = 0;
        if (count($products) > $mp){
            
            $stock = 0;
            $countries = ['AU', 'BR', 'DE', 'GB', 'US'];
            $countriesArr = array();
            foreach ($products as $key => $value) {
                $stock += $value->getStock();
                
                array_push($countriesArr, 'build/images/icons/flags/'.$countries[array_rand($countries)].'.png');

                if (!isset($mostPP)){
                    $mostPP = array();
                    array_push($mostPP, $value);
                }else{
                    if($value->getPrice() * $value->getStock() > $mostPP[0]->getPrice() * $mostPP[0]->getStock()){
                        unset($mostPP);
                        $mostPP = array();
                        array_push($mostPP, $value);
                    }
                }
                
            }

            return $this->render('shop/index.html.twig', [
                'products' => $products,
                'stock' => $stock,
                'mostPP' => $mostPP[0]->getName(),
                'ca' => $countriesArr,
                'mp' => $mp
            ]);
        }else{
            return $this->render('shop/index.html.twig', [
                'products' => $products,
                'mp' => $mp
            ]); 
        }
    }

    #[Route('/alls', name: 'alls')]
    public function alls(): Response
    {
        return $this->render('shop/alls.html.twig', [
            'noAdd' => 1
        ]);
    }

    #[Route('/products/create', name: 'create_product')]
    public function create(Request $request): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $newProduct = $form->getData();

            $this->em->persist($newProduct);
            $this->em->flush();

            return $this->redirectToRoute('products');
        }


        return $this->render('shop/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/products/edit/{id}', name: 'edit_product')]
    public function edit(Request $request, $id): Response
    {
        $product = $this->productRep->find($id);
        $form = $this->createForm(ProductFormType::class, $product);
    
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 

            $product->setName($form->get('name')->getData());
            $product->setStock($form->get('stock')->getData());
            $product->setPrice($form->get('price')->getData());
            $product->setDescription($form->get('description')->getData());

            $this->em->flush();

            return $this->redirectToRoute('products');
        }

        return $this->render('shop/edit.html.twig', [
            'prodcut' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/products/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_product')]
    public function delete($id): Response
    {
        $product = $this->productRep->find($id);
        $this->em->remove($product);
        $this->em->flush();
        
        return $this->redirectToRoute('products');
    }

    #[Route('/products/{id}', name: 'show_product')]
    public function show($id): Response
    {
        $product = $this->productRep->find($id);
        $countries = ['AU', 'BR', 'DE', 'GB', 'US'];
        $ca = 'build/images/icons/flags/'.$countries[array_rand($countries)].'.png';

        return $this->render('shop/show.html.twig', [
            'product' => $product,
            'ca' => $ca
        ]);
    }
}
