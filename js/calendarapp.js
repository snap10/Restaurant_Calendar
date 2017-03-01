(function($) {

    "use strict";

    var options = {
        events_source: 'utils/bookingsjsonprovider.php',
        view: 'month',
        language: 'de-DE',
        time_start:         '06:00',
        time_end:           '24:00',
        time_split:         '60',
        merge_holidays:     true,
        tmpl_path: 'calendar/tmpls/',
        onAfterViewLoad: function(view) {
            $('.page-header h3').text(this.getTitle());
            $('.btn-group button').removeClass('active');
            $('button[data-calendar-view="' + view + '"]').addClass('active');
        },
        classes: {
            months: {
                general: 'label'
            }
        }
    };

    var calendar = $('#calendar').calendar(options);

    $('.btn-group button[data-calendar-nav]').each(function() {
        var $this = $(this);
        $this.click(function() {
            calendar.navigate($this.data('calendar-nav'));
        });
    });

    $('.btn-group button[data-calendar-view]').each(function() {
        var $this = $(this);
        $this.click(function() {
            calendar.view($this.data('calendar-view'));
        });
    });

    $('#first_day').change(function(){
        var value = $(this).val();
        value = value.length ? parseInt(value) : null;
        calendar.setOptions({first_day: value});
        calendar.view();
    });

    $('#language').change(function(){
        calendar.setLanguage($(this).val());
        calendar.view();
    });


   /* $('.show-addevent-form').click(function() {
        loadHTMLTemplate('addevent-form.html')
    });

   var loadHTMLTemplate = function(name) {
        var self = calendar;
        $.ajax({
            url:      self._templatePath(name),
            dataType: 'html',
            type:     'GET',
            async:    false,
            cache:    this.options.tmpl_cache
        }).done(function(html) {
            //TODO
            $('addevent-form-placeholder').innerHTML(html);

        });
    };*/

}(jQuery));