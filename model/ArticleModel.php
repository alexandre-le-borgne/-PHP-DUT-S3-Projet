<?php

/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 18/01/2016
 * Time: 23:12
 */
class ArticleModel extends Model
{

    const EMAIL = 0;
    const TWITTER = 1;
    const RSS = 2;


    public function getById($id)
    {
        if (intval($id)) {
            $db = new Database();
            $result = $db->execute("SELECT * FROM article WHERE id = ?", array($id))->fetch();
            if ($result) {
                $article = new ArticleEntity();
                $article->setId($result['id']);
                $article->setTitle($result['title']);
                $article->setContent($result['content']);
                $article->setDate($result['date']);
                return $article;
            }
        }
        return null;
    }

    /*public function addArticle($title, $content, $date, $type, $url){
        $db = new Database();

        $url = $post->getLink();

        $req = "SELECT * FROM stream_rss WHERE url = ?";
        $result = $db->execute($req, array($url));

        if($result->fetch()){

        }
        else {
            $title = $post->getTitle();
            $content = $post->getText();

            $date = $post->getDate();

            $req = "INSERT INTO article (title, content, articleDate, articleType, url) VALUES (?, ?, ". ArticleModel::RSS  .", ?, ?)";
            $db->execute($req, array($title, $content, $date, $url));
        }

    }*/
}