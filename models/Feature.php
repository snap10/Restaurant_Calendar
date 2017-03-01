<?php

/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 06.02.16
 * Time: 14:22
 */
class Feature
{
    public $id;
    public $name;
    public $description;
    public $picturepath;

    /**
     * Feature constructor.
     * @param $idFeature
     * @param $name
     * @param $description
     * @param $picturepath
     */
    public function __construct($idFeature, $name, $description, $picturepath)
    {
        $this->id = $idFeature;
        $this->name = $name;
        $this->description = $description;
        $this->picturepath = $picturepath;
    }


    public static function find($featureID)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $featureID = intval($featureID);
        $req = $db->prepare('SELECT * FROM features WHERE idFeature = ?');
        $req->bind_param('i',$featureID);
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute();
        $req->bind_result($idFeature,$name,$description,$picturepath);
        $feature = $req->fetch();

        return new Feature($idFeature, $name, $description, $picturepath);
    }
    
     public static function findWithBookingId($id){
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM features WHERE idFeature IN (SELECT Feature_idFeature FROM booking_has_feature WHERE Booking_idBooking = ?)');
        $req->bind_param('i', $id);
        $req->execute();
        $req->bind_result($idFeature,$name,$description,$picturepath);
        $features=[];
        while ($feature = $req->fetch()){
            $features[] = new Feature($idFeature, $name, $description, $picturepath);
        }
        return $features;
    }
    
    public static function findWithVenueId($id){
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM features WHERE idFeature IN (SELECT Feature_idFeature FROM venue_has_feature WHERE Venue_idVenue = ?)');
        $req->bind_param('i', $id);
        $req->execute();
        $req->bind_result($idFeature,$name,$description,$picturepath);
        $features=[];
        while ($feature = $req->fetch()){
            $features[] = new Feature($idFeature, $name, $description, $picturepath);
        }
        return $features;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM features');
        // we create a list of Post objects from the database results
        while ($feature=$req->fetch_assoc()) {
            $list[] = new Feature($feature['idFeature'], $feature['name'], $feature['description'], $feature['picturepath']);
        }
        return $list;
    }


}