<a href="http://ot.com.sa" target="_blank"><button type="button" class="btn btn-primary btn-xs">المحول - برمجة المدار التقني</button></a>
    <!-- jQuery Version 1.11.0 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/raphael/raphael.min.js"></script>
    <script src="js/morris/morris.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="js/jquery/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script src="js/orbit.js"></script>


<script src="js/jquery.plugin.js"></script>
<!--<script src="js/jquery.calendars.all.js"></script><!-- Use instead of calendars, plus, and picker below -->
<script src="js/jquery.calendars.js"></script>
<script src="js/jquery.calendars.plus.js"></script>
<script src="js/jquery.calendars.picker.js"></script>
<!--<script src="js/jquery.calendars.picker.ext.js"></script><!-- Include for ThemeRoller styling -->
<script src="js/jquery.calendars.islamic.js"></script>
<link rel="stylesheet" href="css/jquery.calendars.picker.css" id="theme">

<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="js/docsupport/init.js" type="text/javascript" charset="utf-8"></script>

<script>
        $(document).ready(function() {
          $('#dataTables-example').dataTable();
        });
    </script>
	<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>

<script>
    $(function() {
//	$.calendars.picker.setDefaults({renderer: $.calendars.picker.themeRollerRenderer}); // Requires jquery.calendars.picker.ext.js
        var calendar = $.calendars.instance('islamic');
        $('#popupDatepicker').calendarsPicker({calendar: calendar});
    });

    function showDate(date) {
        alert('The date chosen is ' + date);
    }
</script>
</body>

</html>
