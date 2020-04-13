<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\EditArticleType;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article", name="article")
 */
class ArticleController extends BagSearchController
{
    /**
     * @Route("/view",name=".view" )
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function index(ArticlesRepository $articlesRepository)
    {
        $sArticles = $articlesRepository->findAll();

        return $this->render('article/list.html.twig', [
            'controller_name' => 'ArticleController',
            'sArticles' => $sArticles,
        ]);
    }

    /**
     * @Route("/detail/{id}",name=".detail" )
     * @param $id
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function details($id, ArticlesRepository $articlesRepository)
    {
        $article = $articlesRepository->find($id);

        return $this->render('article/detail.html.twig', [
            'controller_name' => 'ArticleController',
            'sArticle' => $article,
        ]);
    }

    /**
     * @Route("/edit/{id}", name=".edit", defaults={"id": 0})
     * @param Request $request
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function edit(Request $request, ArticlesRepository $articlesRepository)
    {
        $articleId = $request->attributes->get('id');
        $article = $articlesRepository->find($articleId);
        $form = $this->createForm(EditArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $article = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            //set success message
            $this->addFlash('success', 'Thank you, ' . $article->getName() . ' ' . $article->getSku() . ' was saved successfully');

            //return to login
            return $this->redirect($this->generateUrl('article.edit',['id'=>$article->getId()]));
        }

        return $this->render('article/edit.html.twig', [
            'controller_name' => 'ArticleController',
            'articleForm' => $form->createView(),
            'sArticleId' => $articleId
        ]);
    }

    /**
     * @Route("/new", name=".new")
     * @param Request $request
     * @return RedirectResponse
     */
    public function new(Request $request)
    {
        $article = new Articles();
        $article->setName('F MV 1042');
        $article->setEan('4250602310427');
        $article->setDescription('Hepafilter geeignet für Dirt Devil DD7374-8');
        $article->setSku('F MV 1042');
        $article->setActive('1');

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        $this->addFlash('success', 'New Article was created');

        return $this->redirect($this->generateUrl('article.view'));
    }
}
