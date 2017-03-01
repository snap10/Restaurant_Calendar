<?php

require_once ('client.php');
/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 28.01.16
 * Time: 15:46
 */
class Booking
{
    public $id;
    public $description;
    public $startDateTime;
    public $endDateTime;
    public $createdTimeStamp;
    public $modifiedTimeStamp;
    public $approvedDenyTimeStamp;
    public $uniqueCode;
    public $client;
    public $bookingState;
    public $venues;
    public $features;

    /**
     * Booking constructor.
     * @param $id
     * @param $description
     * @param $startDateTime
     * @param $endDateTimey
     * @param $createdTimeStamp
     * @param $modifiedTimeStamp
     * @param $approvedDenyTimeStamp
     * @param $uniqueCode
     * @param $client
     * @param $bookingState
     */
    public function __construct($id, $clientID, $description, $startDateTime, $endDateTime, $createdTimeStamp, $modifiedTimeStamp, $approvedDenyTimeStamp, $bookingState, $uniqueCode)
    {
        $this->id = $id;
        $this->description = $description;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
        $this->createdTimeStamp = $createdTimeStamp;
        $this->modifiedTimeStamp = $modifiedTimeStamp;
        $this->approvedDenyTimeStamp = $approvedDenyTimeStamp;
        $this->uniqueCode = $uniqueCode;
        $this->client = Client::find($clientID);
        $this->bookingState = $bookingState;
        $this->venues = $this->getVenues();
        $this->features =$this->getFeatures();

    }

    public function getBookingStateName(){
        switch($this->bookingState){
            case 0:
                return 'noch nicht bearbeitet';
                break;
            case 1:
                return 'Bestätigt';
                break;
            case 2:
                return 'Abgelehnt';
                break;
            default:
                return 'Error, nicht bekannter Wert';
                break;

        }
    }


    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM bookings');

        // we create a list of Post objects from the database results
        while ($booking=$req->fetch_assoc()) {
            $list[] = new Booking ($booking['idBooking'], $booking['Client_idClient'], $booking['description'], $booking['startDateTime'], $booking['endDateTime'], $booking['createTimeStamp'], $booking['modifiedTimeStamp'], $booking['approveDenyTimeStamp'], $booking['bookingstate'], $booking['uniqueCode']);
        }
        return $list;
    }


    public static function allFromTo($from,$to)
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM bookings WHERE startDateTime BETWEEN ? AND ?');
        $req->bind_param('ss', $from,$to);
        $req->execute();
        $req->bind_result($idBooking,$Client_idClient,$description,$startDateTime,$endDateTime,$createdTimeStamp,$modifiedTimeStamp,$approvedDenyTimeStamp,$bookingstate,$uniqueCode);
         
        // we create a list of Post objects from the database results

         while ($booking = $req->fetch()) {
            $listTmp[] = array($idBooking,$Client_idClient,$description,$startDateTime,$endDateTime,$createdTimeStamp,$modifiedTimeStamp,$approvedDenyTimeStamp,$bookingstate,$uniqueCode);
         }
         foreach ($listTmp as $booking) {
              $list[]=new Booking($booking[0],$booking[1],$booking[2],$booking[3],$booking[4],$booking[5],$booking[6],$booking[7],$booking[8],$booking[9]) ;
          }
        return $list;
    }


    public static function find($id)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        if ($id != null) {
            $req = $db->prepare('SELECT * FROM bookings WHERE idBooking = ?');
            $req->bind_param('i', $id);
            $req->execute();
            $req->bind_result($idBooking,$Client_idClient,$description,$startDateTime,$endDateTime,$createdTimeStamp,$modifiedTimeStamp,$approvedDenyTimeStamp,$bookingstate,$uniqueCode);
            $booking = $req->fetch();
            $req->close();
            return new Booking ($idBooking,$Client_idClient,$description,$startDateTime,$endDateTime,$createdTimeStamp,$modifiedTimeStamp,$approvedDenyTimeStamp,$bookingstate,$uniqueCode);
        } else {

        }
    }

    /**
     * Creates a new Booking entry in the Database
     * @param $description
     * @param $clientid
     * @param $begindatetime
     * @param $enddatetime
     * @param $newchecklist
     */
    public static function createnew($description, $clientid, $begindatetime, $enddatetime, $venuelist,$featurelist)
    {
        $uniqueCode = Helper::getUniqueCode();
        $bookingstate = 0;
        $begindatetime=$begindatetime->format('Y-m-d H:i:s');
        $enddatetime=$enddatetime->format('Y-m-d H:i:s');
        $db = Db::getInstance();
        if ($stmt = $db->prepare('INSERT INTO bookings (description,Client_idClient,startDateTime,endDateTime,bookingstate,uniqueCode) VALUES(?,?,?,?,?,?)')) {
            $stmt->bind_param('sissis', $description, $clientid,$begindatetime , $enddatetime, $bookingstate, $uniqueCode);
            $stmt->execute();
            $bookingid = $stmt->insert_id;
            $stmt = $db->prepare('INSERT INTO venues_has_booking(Venue_idVenue,Booking_idBooking) VALUES(?,?)');
            $db->query("START TRANSACTION");
            if($venuelist){
                foreach ($venuelist as $venueid) {
                    $stmt->bind_param('ii', $venueid, $bookingid);
                    $stmt->execute();
                }
            }
            if($featurelist){
                $stmt = $db->prepare('INSERT INTO booking_has_feature(Booking_idBooking,Feature_idFeature) VALUES(?,?)');
                foreach ($featurelist as $featureid) {
                    $stmt->bind_param('ii',$bookingid, $featureid);
                    $stmt->execute();
                }
            }

            $stmt->close();
            $db->query("COMMIT");

            return $bookingid;

        } else {
            //TODO
            var_dump($db->error);
        }
    }

    public static function activate($id, $uniqueCode)
    {   $newBookingState = 1;
        $db = Db::getInstance();
        $id = intval($id);
        if ($id != null&&$uniqueCode!=null) {
            $req = $db->prepare('UPDATE bookings SET bookingstate = ?,approveDenyTimeStamp = NOW() WHERE uniqueCode= ? AND idBooking = ?');
            $req->bind_param('iii',$newBookingState,$uniqueCode, $id);
            $req->execute();
            $result = $req->affected_rows;
            if($result==1){
                return true;
            }else{return false;}
        } else {
            return false;
        }
    }

    public static function deny($id, $uniqueCode)
    {
        $newBookingState = 2;
        $db = Db::getInstance();
        $id = intval($id);
        if ($id != null&&$uniqueCode!=null) {
            $req = $db->prepare('UPDATE bookings SET bookingstate = ?,approveDenyTimeStamp = NOW() WHERE uniqueCode= ? AND idBooking = ?');
            $req->bind_param('iii',$newBookingState,$uniqueCode, $id);
            $req->execute();
            $result = $req->affected_rows;
            if($result==1){
                return true;
            }else{return false;}
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public
    function getVenues()
    {
       $this->venues= Venue::findWithBookingId($this->id);
        
        return $this->venues;
    }

    /**
     * @return array
     */
    public
    function getFeatures()
    {
       $this->features=Feature::findWithBookingId($this->id);
        return $this->features;

    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }



}