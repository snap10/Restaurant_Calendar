<?php

/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 06.02.16
 * Time: 14:00
 */
class Venue
{
    public $id;
    public $name;
    public $description;
    public $picturepath;
    public $features;

    /**
     * Venue constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $picturepath
     * @param $featurelist
     */
    public function __construct($id, $name, $description, $picturepath)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->picturepath = $picturepath;
        $this->features = [];
    }

    public static function find($venueID)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $venueID = intval($venueID);
        $req = $db->prepare('SELECT * FROM venues WHERE idVenue = ?');

        $req->bind_param('i',$venueID);
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute();
        $req->bind_result($idVenue,$name,$description,$picturepath,$featurelist);
        $venue = $req->fetch();


        return new Venue($idVenue, $name, $description, $picturepath);
    }
    
    public static function findWithBookingId($id){
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM venues WHERE idVenue IN (SELECT Venue_idVenue FROM venues_has_booking WHERE Booking_idBooking = ?)');
        $req->bind_param('i', $id);
        $req->execute();
        $req->bind_result($idVenue,$name,$description,$picturepath,$featurelist);
        $venues=[];
        while ($venue= $req->fetch()){
            $venues[] = new Venue($idVenue, $name, $description, $picturepath);
        }
        return $venues;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM venues');

        // we create a list of Post objects from the database results
        while ($venue= $req->fetch_assoc()) {
            $list[] = new Venue($venue['idVenue'], $venue['name'], $venue['description'], $venue['picturepath']);
        }
        return $list;
    }

    /**
     * @return array
     */
    public
    function getFeatures()
    {
        $this->features = Feature::findWithVenueId($this->id);
        return $this->features;

    }

}