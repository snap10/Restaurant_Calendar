<script type="text/javascript"
        src="js/moment-with-locales.min.js"></script>

<script type="text/javascript"
        src="js/bootstrap-datetimepicker.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<div id="cal-slide-content" class="cal-event-list">
    <div id="addeventbuttonsection">
        <div id="add-event" class="btn btn-primary"><span class="glyphicon-plus"> Neuen Termin anfragen</span></div>
    </div>
    <div id="addevent-form-placeholder"  >

        <div>
            <form id="bookingform" class="form-horizontal" method="post" action="index.php?controller=bookings&action=create" >
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
                            <input id="phone" class="form-control input-lg" name="phone" placeholder="Nummer"
                                   class="input-medium"
                                   required=""
                                   type="text">

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
                            <input id="street" class="form-control" name="street" placeholder="Straße" class="input-medium"
                                   type="text">

                        </div>
                    </div>
                    <div class="col-sm-4">

                        <label class="control-label" for="housenumber">Hausnummer</label>
                        <div class="controls">
                            <input id="housenumber" class="form-control" name="housenumber" placeholder="Hausnummer"
                                   class="input-medium"
                                   type="number">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label" for="zipcode">PLZ</label>
                        <div class="controls">
                            <input id="zipcode" class="form-control" name="zipcode" placeholder="PLZ" class="input-medium"
                                   type="number">
                        </div>
                    </div>
                    <div class="col-sm-8">

                        <label class="control-label" for="city">Ort</label>
                        <div class="controls">
                            <input id="city" class="form-control" name="city" placeholder="Ort" class="input-medium"
                                   type="text">

                        </div>
                    </div>
                </div>


                <div id="venuesList" class="form-group">
                    <div class="col-sm-12">
                        <label for="venuetable">Räume auswählen</label>
                        <table id="venuetable" class="table">
                            <thead>
                            <tr>

                                <th>
                                    ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Beschreibung
                                </th>
                                <th>
                                    Bild
                                </th>
                                <th>Features</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($venues as $venue) { ?>
                            <tr>
                                <td>
                                    <div class="checkbox required">
                                        <label><input id="venuebox<?php echo $venue->id ?>" name="venuelist[]"
                                                      value="<?php echo $venue->id ?>"
                                                      type="checkbox" class="group-required"  /><?php echo $venue->id ?>
                                        </label>
                                    </div>
                                </td>
                                <td><?php echo $venue->name ?></td>
                                <td><?php echo $venue->description ?></td>
                                <td><img src="<?php echo $venue->picturepath ?>"></td>
                                <td><?php foreach ($venue->getFeatures() as $feature) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <input id="featurebox<?php echo $feature->id ?>" name="featurelist[]"
                                                   value="<?php echo $feature->id ?>"
                                                   type="checkbox"><?php echo $feature->name ?>
                                        </label>
                                        <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>

                        </div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $(function () {
                                    $('#datetimepickerstart').datetimepicker({locale: 'de'});
                                });
                            });
                        </script>
                    </div>
                    <div class="col-sm-6">
                        <label for="datetimepickerend">Bis*</label>
                        <div class='input-group date' id='datetimepickerend'>
                            <input type='text' class="form-control" name="enddatetime" required/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $(function () {
                                    $('#datetimepickerend').datetimepicker({
                                        locale: 'de',
                                    });
                                });
                            });
                        </script>

                    </div>

                </div>


                <div class="form-group">
                    <div class="controls">
                        <button type="submit"  class="btn">Submit</button>
                    </div>
                </div>
            </form>

        </div>




    </div>



    <script>


    $("#add-event").click(function () {

        var button = $(this);
        //getting the next element
        var content = $('#addevent-form-placeholder');

        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        content.slideToggle(500,function(){
            if(content.is(":visible")){
                button.html("<span class='glyphicon glyphicon-remove'> Schließen</span>");
            }else{
             button.html("<span class='glyphicon-plus'> Neuen Termin anfragen</span>");
            }

        });


    });
</script>


    <!-- Latest compiled and minified JavaScript -->
    <ul class="unstyled list-unstyled">
        <% _.each(events, function(event) { %>
        <li>
            <span class="pull-left event <%= event['class'] %>"></span>&nbsp;
            <a href="<%= event.url ? event.url : 'javascript:void(0)' %>" data-event-id="<%= event.id %>"
               data-event-class="<%= event['class'] %>" class="event-item">
                <%=event.title %></a>
        </li>
        <% }) %>
    </ul>
</div>
<span id="cal-slide-tick" style="display: none"></span>
