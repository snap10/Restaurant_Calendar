<?php

/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 06.02.16
 * Time: 15:16
 */
class VenuesController
{
    public function index() {
        // we store all the posts in a variable
        $venues = Venue::all();
        require_once('views/venues/index.php');
    }

    public function show() {
        // we expect a url of form ?controller=posts&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        if (!isset($_GET['id']))
            return call('pages', 'error');

        // we use the given id to get the right post
        $venue = Venue::find($_GET['id']);
        require_once('views/venues/show.php');
    }
}