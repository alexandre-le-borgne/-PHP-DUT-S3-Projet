<?php

/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 23/01/2016
 * Time: 21:19
 */
class ArticleController extends Controller
{
    public function AddStreamAction()
    {
        $this->render('layouts/addStream');
    }

    public function FavorisAction(Request $request)
    {
        if (!$request->getSession()->isGranted(Session::USER_IS_CONNECTED))
        {
            $this->redirectToRoute('index');
        }
        else
        {
            $this->loadModel('ArticleModel');
            $articles = $this->articlemodel->getArticlesFavorisByUserId($request->getSession()->get('id'), 0, 10);
            $data = array('title' => 'Mes favoris', 'articles' => $articles);
            $this->render('layouts/home', $data);
        }
    }

    public function CategoryAction(Request $request, $id) {
        if (!$request->getSession()->isGranted(Session::USER_IS_CONNECTED))
        {
            $this->redirectToRoute('index');
        }
        else
        {
            $this->loadModel('CategoryModel');
            $this->loadModel('ArticleModel');
            /** @var CategoryEntity $categoryEntity */
            $categoryEntity = $this->categorymodel->getById($id);
            if($categoryEntity && $categoryEntity->getAccount() == $request->getSession()->get('id')) {
                $articles = $this->articlemodel->getArticlesByCategoryId($categoryEntity->getId(), 0, 10);
                $data = array('title' => $categoryEntity->getTitle(), 'articles' => $articles);
                $this->render('layouts/home', $data);
            }
            else {
                $this->redirectToRoute('index');
            }
        }
    }

    public function StreamAction(Request $request, $type, $id) {
        if (!$request->getSession()->isGranted(Session::USER_IS_CONNECTED))
        {
            $this->redirectToRoute('index');
        }
        else
        {
            $this->loadModel('CategoryModel');
            $this->loadModel('ArticleModel');
            $this->loadModel('EmailModel');
            $this->loadModel('TwitterModel');
            $this->loadModel('RssModel');
            switch ($type)
            {
                case ArticleModel::RSS:
                    /** @var RssEntity $stream */
                    $stream = $this->rssmodel->getStreamById($id);
                    if(!$stream)
                        $this->redirectToRoute('index');
                    $title = $stream->getUrl();
                    break;
                case ArticleModel::TWITTER:
                    /** @var TwitterEntity $stream */
                    $stream = $this->twittermodel->getStreamById($id);
                    if(!$stream)
                        $this->redirectToRoute('index');
                    $title = $stream->getChannel();
                    break;
                case ArticleModel::EMAIL:
                    /** @var EmailEntity $stream */
                    $stream = $this->emailmodel->getStreamById($id);
                    var_dump($stream);
                    if(!$stream)
                        $this->redirectToRoute('index');
                    $title = $stream->getAccount();
                    break;
                default:
                    $this->redirectToRoute('index');
                    return;
            }
            // L'utilisateur a acces a ce flux car fait parti d'une de ces categories
            if($this->articlemodel->userHasStream($request->getSession()->get('id'), $stream, $type))
            {
                $articles = $this->articlemodel->getArticlesByStreamTypeAndId($type, $id, 0, 10);
                $data = array('title' => $title, 'articles' => $articles);
                $this->render('layouts/home', $data);
            }
            else {
                $this->redirectToRoute('index');
            }
        }
    }

    public function ArticleAction(Request $request, $id)
    {
        if($request->isInternal()) {
            $this->loadModel('ArticleModel');
            /** @var ArticleEntity $article */
            $article = $this->articlemodel->getById($id);
            if($article)
            {
                $user = $request->getSession()->get('id');
                //$favoris = $this->articlemodel->getIdOfFavoris($request->getSession()->get('id'));
                //Renvoyer des boolean Est dans les favoris,est dans les stream des followers, est dans le blog perso ou pas, etc
                $favoris = $this->articlemodel->getArticleFromBlog($user, $article->getId());
                $blog = $this->articlemodel->getArticleFromBlog($user, $article->getId());
                $this->render('layouts/article', array('article' => $article, 'favoris' => $favoris, 'blog' => $blog));
            }
        }
        else {
            $this->loadModel('ArticleModel');
            /** @var ArticleEntity $article */
            $article = $this->articlemodel->getById($id);
            if($article)
            {
                $this->render('layouts/home', array('title' => $article->getTitle(), 'articles' => array($article)));
            }
            else {
                $this->redirectToRoute('index');
            }
        }
    }
}