    <script type="text/javascript" src="js/underscore-min.js"></script>
    <script type="text/javascript" src="js/calendar.js"></script>
    <script type="text/javascript" src="js/language/de-DE.js"></script>
    <?php
    if($message){
       ?>
    <div class="alert alert-warning">

         <?php echo $message;?>
    </div>
    <?php } ?>
    <div class="row customsection" ><a class="btn btn-lg btn-block btn-primary"  data-toggle="collapse" data-target="#bookingsection"><span><i class="fa fa-plus"></i> Neue Anfrage stellen</span></a>
    <div id="bookingsection" class="collapse">
        <?php require_once('views/bookings/newbooking.php');?>
    </div>
    </div>
    <div class="page-header">
        <div class="pull-xs-right form-inline">
            <div class="btn-group">
                <button class="btn btn-primary" data-calendar-nav="prev"><< Zurück</button>
                <button class="btn" data-calendar-nav="today">Heute</button>
                <button class="btn btn-primary" data-calendar-nav="next">Vor >></button>
            </div>
            <div class="btn-group">
                <button class="btn btn-warning" data-calendar-view="year">Jahr</button>
                <button class="btn btn-warning active" data-calendar-view="month">Monat</button>
                <button class="btn btn-warning" data-calendar-view="week">Woche</button>
                <button class="btn btn-warning" data-calendar-view="day">Tag</button>
            </div>
        </div>
        <h3></h3>
    </div>

    <div id="calendar">
        <script type="text/javascript" src="js/calendarapp.js"></script>
    </div>

