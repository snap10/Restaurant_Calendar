<?php

/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 04.03.16
 * Time: 00:31
 */
class EmailComposer
{


    public static function getActivationEmailHTML(Booking $booking)
    {

        $entrytext = 'Dummy Caption';
        $reservationtext = 'Name:' . $booking->client->firstname . ' ' . $booking->client->surename . '</br>Email:' . $booking->client->email . '</br>Telefon:' . $booking->client->phone . '</br>Von:' . $booking->startDateTime . '</br>Bis:' . $booking->endDateTime . '</br>Kommentar:' . $booking->description;
        $actiontext = 'Durch klick auf die Buttons wird die Aktion auf die Anfrage angewandt. <em>Internetverbindung erforderlich</em> <div id="buttons"><a id="approve" class="btn green" href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=activatereservation&id=' . $booking->id . '&activationtoken=' . $booking->uniqueCode . '" >Bestaetigen</a><a id="view" class="btn green" href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=showfromextern&id=' . $booking->id.'&activationtoken=' . $booking->uniqueCode . '">Details ansehen</a><a id="deny" class="btn red" href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=denyreservation&id=' . $booking->id . '&activationtoken=' . $booking->uniqueCode . '" >Ablehnen</a></div>';
        $htmlbody = '
        <html >
            <head>
             <meta charset="UTF-8"/>
             <style>
                body{
                font-family:Helvetica, Arial, sans-serif; ;
                }
                #buttons{
                padding:10px;
                }
                #approve{
                    padding:5px;
                    background: #00bb00;
                    color:#fff;
                    border-radius: 2px;
                    margin:5px;
                }
                #deny{
                    padding:5px;
                    background: #bb0000;
                    color:#fff;
                    border-radius: 2px;
                    margin:5px;
                }
                #view{
                    padding:5px;
                    background: #f0cd2e;
                    color:#fff;
                    border-radius: 2px;
                    margin:5px;
                }
                #information{
                    padding:20px;
                    background:#eee;
                }
                #actions{
                    background:#ddd;
                    padding:20px;
                                    }
                #caption{
                    background:#ddd;
                    padding:20px;
                }
            </style>
            </head>
            <body>
                <h3 id="caption">' . $entrytext . '</h3>
                <div id="information">
                    <p>
                      ' . $reservationtext . '
                    </p>
                </div>
                <div id="actions">
                    ' . $actiontext . '
                </div>
            </body>
        </html>
        ';

        return $htmlbody;
    }

    public static function getActivationEmailPlain(Booking $booking)
    {

        $entrytext = 'Dummy Caption';
        $reservationtext = 'Name:' . $booking->client->firstname . ' ' . $booking->client->surename . '</br>Email:' . $booking->client->email . '</br>Telefon:' . $booking->client->phone . '</br>Von:' . $booking->startDateTime . '</br>Bis:' . $booking->endDateTime . '</br>Kommentar:' . $booking->description;
        $actiontext = 'Durch klick auf die Buttons wird die Aktion auf die Anfrage angewandt. <em>Internetverbindung erforderlich</em> <div id="buttons"><a id="approve" class="btn green" href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=activatereservation&id=' . $booking->id . '&activationtoken=' . $booking->uniqueCode . '" >Bestaetigen</a><a id="view" class="btn green" href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=showfromextern&id=' . $booking->id.'&activationtoken=' . $booking->uniqueCode . '">Details ansehen</a><a id="deny" class="btn red" href="http://localhost/restaurant_calendar/index.php?controller=bookings&action=denyreservation&id=' . $booking->id . '&activationtoken=' . $booking->uniqueCode . '" >Ablehnen</a></div> klicken';
        $plainbody = $entrytext.'
        '.$reservationtext.'
        '.$actiontext;

        return $plainbody;
    }

    public static function getInitialCustomerEmailHTML(Booking $booking){
        $caption = 'Dummy Caption';
        $entrytext='Dummy Text';
        $reservationtext = '<h3>Zur Kontrolle:</h3><p>Name:' . $booking->client->firstname . ' ' . $booking->client->surename . '</br>Email:' . $booking->client->email . '</br>Von:' . $booking->startDateTime . '</br>Bis:' . $booking->endDateTime . '</br>Kommentar:' . $booking->description.'</p>';

        $htmlbody = '
        <html >
            <head>
             <meta charset="UTF-8"/>
             <style>
                body{
                font-family:Helvetica, Arial, sans-serif; ;
                }
                #buttons{
                padding:10px;
                }

                #information{
                    padding:20px;
                    background:#eee;
                }
                #caption{
                    background:#ddd;
                    padding:20px;
                }
                #entry{
                    background:#eee;
                    padding:20px;
                }
            </style>
            </head>
            <body>
                <h3 id="caption">' . $caption . '</h3>
                <div id="entry">'.$entrytext.'</div>
                <div id="information">
                    <p>
                      ' . $reservationtext . '
                    </p>
                </div>

            </body>
        </html>
        ';

        return $htmlbody;
    }

    public static function getInitialCustomerEmailPlain(Booking $booking){
        $caption = 'Dummy Caption';
        $entrytext='Dummy Text';
        $reservationtext = 'Zur Kontrolle:
        Name:' . $booking->client->firstname . ' ' . $booking->client->surename . '
        Email:' . $booking->client->email . '
        Telefon:' . $booking->client->phone . '
        Von:' . $booking->startDateTime . '
        Bis:' . $booking->endDateTime . '
        Kommentar:' . $booking->description;
        $plainbody =  $caption. '
        '.$entrytext.  '
        '. $reservationtext;

        return $plainbody;
    }
}