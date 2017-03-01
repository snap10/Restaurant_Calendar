<?php
/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 10.02.16
 * Time: 12:06
 */
$venues = Venue::all();
?>
    <div class="container-fluid">
        <form id="bookingform" class="form-horizontal" method="post" action="index.php?controller=bookings&action=create">
            <div class="form-group">
                <div class="col-sm-4">
                    <label class="control-label" for="inputEmail">Email*</label>
                    <div class="controls">
                        <input type="text" class="form-control input-lg" name="inputEmail" placeholder="Email" required>
                    </div>

                </div>
                <div class="col-sm-4">
                    <label class="control-label" for="phone">Telefon/Mobil*</label>
                    <div class="controls">
                        <input id="phone" class="form-control input-lg" name="phone" placeholder="Nummer" class="input-medium" required="" type="text">

                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="sel1">Extern oder Vereinsabteilung?:</label>
                    <div class="controls">

                        <select name="division" class="form-control input-lg" id="sel1">
                        <option>Bitte auswählen...</option>
                        <option>Extern</option>
                        <option>Gesamtverein</option>
                        <option>Fußball</option>
                        <option>Ski</option>
                        <option>Gymnastik</option>
                        <option>Volleyball</option>
                        <option>Tischtennis</option>
                        <option>Tennis</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="control-label" for="inputFirstname">Vorname</label>
                    <div class="controls ">
                        <input type="name" class="form-control" name="firstname" placeholder="Vorname">
                    </div>
                </div>

                <div class="col-sm-6">
                    <label class="control-label" for="inputSurename">Nachname</label>
                    <div class="controls ">
                        <input type="name" class="form-control" name="surename" placeholder="Nachname">
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <div class="col-sm-8">
                    <label class="control-label" for="street">Straße</label>
                    <div class="controls">
                        <input id="street" class="form-control" name="street" placeholder="Straße" class="input-medium" type="text">

                    </div>
                </div>
                <div class="col-sm-4">

                    <label class="control-label" for="housenumber">Hausnummer</label>
                    <div class="controls">
                        <input id="housenumber" class="form-control" name="housenumber" placeholder="Hausnummer" class="input-medium" type="number">
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="control-label" for="zipcode">PLZ</label>
                    <div class="controls">
                        <input id="zipcode" class="form-control" name="zipcode" placeholder="PLZ" class="input-medium" type="number">
                    </div>
                </div>
                <div class="col-sm-8">

                    <label class="control-label" for="city">Ort</label>
                    <div class="controls">
                        <input id="city" class="form-control" name="city" placeholder="Ort" class="input-medium" type="text">

                    </div>
                </div>
            </div>

            <?php require_once('views/venues/index.php'); ?>
           
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="comment">Kommentar:</label>
                        <textarea class="form-control" rows="5" id="comment" name="description" PLACEHOLDER="Bitte kurz beschreiben worum es geht..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="datetimepickerstart">Von*</label>
                        <div class='input-group date' id='datetimepickerstart'>
                            <input type='text' class="form-control" name="begindatetime" required/>
                            <span class="input-group-addon">
                       <i class="fa fa-calendar" aria-hidden="true"></i>

                            </span>

                        </div>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $(function() {
                                    $('#datetimepickerstart').datetimepicker({
                                        locale: 'de'
                                    });
                                });
                            });
                        </script>
                    </div>
                    <div class="col-sm-6">
                        <div class="radio-inline">
                             <label><input id="untilclose" class="untildateradio" type="radio" name="untilradio" value="untilclose" checked>Bis Betriebsschluss</label>
                        </div>
                        <div class="radio-inline">
                            <label><input id="untildatetime" class="untildateradio" type="radio" name="untilradio" value="untildatetime">
                            Bis*
                            <div class='input-group date' id='datetimepickerend'>
                                <input id="inputuntildatetime" type='text' class="form-control" name="enddatetime" required disabled/>
                                <span class="input-group-addon">
                       <i class="fa fa-calendar" aria-hidden="true"></i>

                                </span>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $(function() {
                                        $('#datetimepickerend').datetimepicker({
                                            locale: 'de',
                                        });
                                    });
                                });
                            </script>
                            </label>
                        </div>
                            <script type="text/javascript">
                            $(document).ready(function(){
                                $('#untildatetime').click(function()
                                {
                                    $('#inputuntildatetime').removeAttr("disabled");
                                });

                                $('#untilclose').click(function()
                                {
                                $('#inputuntildatetime').attr("disabled","disabled");
                                });
                              
                            })
                            </script>
                           
                        </div>
                    </div>

                </div>


                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-lg btn-block btn-success">Abschicken</button>
                    </div>
                </div>
        </form>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

        <script type="text/javascript">
            $("#bookingform").validate({
                rules: {
                    inputEmail: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    inputEmail: {
                        email: "<span class='label label-warning'>Bitte ein gültige Email eingeben!</span>"
                    }
                }

            });
        </script>

        </div>
        <script type="text/javascript" src="js/moment-with-locales.min.js"></script>

        <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>