<?php
/**
 * Le Controlleur correspondant a l'index
 *
 */

class IndexController extends Controller
{
    public function IndexAction()
    {
        $this->loadModel('IndexModel');
        $this->render('persists/home');
    }

    public function FeedAction($a, $b, $c)
    {
        $feed = new RSSReaderModel("http://www.journaldunet.com/rss/");
        //var_dump($feed->getPosts());
        foreach($feed->getPosts() as $post) {
            echo $post->getSummary();
        }
    }
}