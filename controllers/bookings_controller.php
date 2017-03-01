<?php
require_once('utils/helper.php');
require_once('utils/emailComposer.php');

/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 06.02.16
 * Time: 15:05
 */
class BookingsController
{
    public function index()
    {
        // we store all the posts in a variable
        $bookings = Booking::all();
        require_once('views/bookings/index.php');
    }

    public function show()
    {
        // we expect a url of form ?controller=posts&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        if (!isset($_GET['id']))
            return call('pages', 'error');

        // we use the given id to get the right post
        $booking = Booking::find($_GET['id']);
        require_once('views/bookings/show.php');
    }

    public function showfromextern()
    {
        // we expect a url of form ?controller=posts&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        if (!isset($_GET['id']) || !isset($_GET['activationtoken']))
            return call('pages', 'notallowed');

        // we use the given id to get the right post
        $id = $this->test_input($_GET['id']);
        $booking = Booking::find($id);
        $activationtoken = $this->test_input($_GET['activationtoken']);
        if (strcmp($booking->uniqueCode, $activationtoken) != 0){
                        return call('pages', 'notallowed');
        }else{
            $showfromextern=true;
            require_once('views/bookings/show.php');
        }
    }

    public function newbooking()
    {

        require_once('views/bookings/newbooking.php');
    }

    public function create()
    {

        $firstname = $this->test_input($_POST['firstname']);
        $email = $this->test_input($_POST['inputEmail']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            callWithMessage('pages','home','<h1>Nicht erfolgreich!</h1><p>Keine korrekte Email eingegeben</p>');
            return;
        }
        $surename = $this->test_input($_POST['surename']);
        $street = $this->test_input($_POST['street']);
        $housenumber = $this->test_input($_POST['housenumber']);
        $zip = $this->test_input($_POST['zipcode']);
        $city = $this->test_input($_POST['city']);
        $phone = $this->test_input($_POST['phone']);
        $division = $this->test_input($_POST['division']);
        if (strcmp($division, 'Bitte auswählen...') == 0) $division = null;

        $description = $this->test_input($_POST['description']);
        $venuelist = [];
        $newchecklist = [];
        $featurelist = [];
        if (isset($_POST['venuelist'])) {
            $venuelist = $_POST['venuelist'];
            foreach ($venuelist as $check) {
                $newchecklist[] = intval($this->test_input($check));
            }
            $venuelist = $newchecklist;
        };

        if (isset($_POST['featurelist'])) {
            $featurelist = $_POST['featurelist'];
            foreach ($featurelist as $featureid) {
                $newchecklist[] = intval($this->test_input($featureid));
            }
            $featurelist = $newchecklist;
        };
        $begindatetime = DateTime::createFromFormat('d.m.Y H:i', $this->test_input($_POST['begindatetime']));
        if (isset($_POST['untilradio'])) {
            $option = $this->test_input($_POST['untilradio']);
            if (strcmp($option, 'untildatetime') == 0) {
                $enddatetime = DateTime::createFromFormat('d.m.Y H:i', $this->test_input($_POST['enddatetime']));
            } else {
                $endOfDay = clone $begindatetime;
                $endOfDay->modify('tomorrow');
                // adjust from the next day to the end of the day, per original question
                $endOfDay->modify('1 second ago');
                $enddatetime = $endOfDay;
            }
        }else {
                $endOfDay = clone $begindatetime;
                $endOfDay->modify('tomorrow');
                // adjust from the next day to the end of the day, per original question
                $endOfDay->modify('1 second ago');
                $enddatetime = $endOfDay;
        }  

        $clientid = Client::createnew($firstname, $surename, $email, $street, $housenumber, $zip, $city, $phone, $division);

        $bookingid = Booking::createnew($description, $clientid, $begindatetime, $enddatetime, $venuelist, $featurelist);
        //TODO provide correct view
        $booking = Booking::find($bookingid);
        $subject = 'Neue Reservierung for das Sportheim';
        $body = EmailComposer::getActivationEmailHTML($booking);

        $plainbody = EmailComposer::getActivationEmailPlain($booking);
        $receiver = 'sportheim@sv-baltringen.de';
        ?>
        <div class="alert alert-success">
            <p>
                <?php
                echo Helper::mailto($receiver, $subject, $body, $plainbody);
                ?>
                </p>
            <p>
                <?php
                echo Helper::mailto($booking->client->email, 'Reservierungsanfrage wird bearbeitet', EmailComposer::getInitialCustomerEmailHTML($booking), EmailComposer::getActivationEmailPlain($booking));
                ?>
            </p>

        </div>
        <?php
        $showfromextern=true;
        require_once('views/bookings/show.php');

    }

    public function activatereservation()
    {

        $id = $this->test_input(intval($_GET['id']));
        $uniqueCode = $this->test_input($_GET['activationtoken']);

        print_r($result = Booking::activate($id, $uniqueCode));
        if ($result) {
            //TODO format Email
            $subject = 'Ihre Reservierung wurde bestätigt';
            $body = 'Details zu ihrer Reservierung <a href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=show&id=' . $id . '">hier!</a>';
            $plainbody = 'Details zu ihrer Reservierung finden sie auf http://localhost/restaurant_calendar/index.php?controller=bookings&action=show&id=' . $id;
            $receiver = Booking::find($id)->client->email;
            echo Helper::mailto($receiver, $subject, $body, $plainbody);
        } else {
            echo 'Some error occured, please contact the Administrator';
        }
    }

    public function denyreservation()
    {

        $id = $this->test_input(intval($_GET['id']));
        $uniqueCode = $this->test_input($_GET['activationtoken']);
        print_r($result = Booking::deny($id, $uniqueCode));
        if ($result) {
            //TODO format Email
            $subject = 'Ihre Reservierung wurde leider abgelehnt';
            $body = 'Details zu ihrer Reservierung <a href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=show&id=' . $id . '">hier!</a>';
            $plainbody = 'Details zu ihrer Reservierung finden sie auf http://localhost/restaurant_calendar/index.php?controller=bookings&action=show&id=' . $id;
            $receiver = Booking::find($id)->client->email;
            echo Helper::mailto($receiver, $subject, $body, $plainbody);
        } else {
            echo 'Some error occured, please contact the Administrator';
        }
    }

    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>
