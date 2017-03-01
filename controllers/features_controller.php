<?php

/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 06.02.16
 * Time: 15:16
 */
class FeaturesController
{
    public function index() {
        // we store all the posts in a variable
        $features = Feature::all();
        require_once('views/features/index.php');
    }

    public function show() {
        // we expect a url of form ?controller=posts&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        if (!isset($_GET['id']))
            return call('pages', 'error');

        // we use the given id to get the right post
        $feature = Feature::find($_GET['id']);
        require_once('views/features/show.php');
    }
}