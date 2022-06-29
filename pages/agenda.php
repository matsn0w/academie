
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: "<?php echo $site; ?>/includes/json-calendar.php",
            loading: function(bool) {
                if (bool) $('#loading').show();
                else $('#loading').hide();
            },
            timeFormat: 'H:mm',
               monthNames: ["Januari","Februari","Maart","April","Mei","Juni","Juli", "Augustus", "September", "Oktober", "November", "December" ], 
               monthNamesShort: ['Jan','Feb','Mrt','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec'],
               dayNames: [ 'Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag'],
               dayNamesShort: ['Zon','Maa','Din','Woe','Don','Vri','Zat'],
               buttonText: {
                today: 'Vandaag',
                month: 'Maand',
                week: 'Week',
                day: 'Dag'
               }
		});
		
	});

</script>
<style>
	#calendar {
		margin: 0 auto;
	}

</style>
<div class="row wrapper">
    <div class="col-lg-8">
        <h2>Agenda</h2>
        <ol class="breadcrumb" style="background-color:#f3f3f4">
            <li>
                <a href="<?php echo $site; ?>/home">Home</a>
            </li>
            <li class="active">
                <strong>Agenda</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Agenda </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>