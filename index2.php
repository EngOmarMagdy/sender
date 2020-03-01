<!DOCTYPE html>
<html lang="ar">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="أرشفني">
    <meta name="author" content="mohammed salah">

    <title>نظام الاتصالات لجنة تراحم جازان</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/rtl/bootstrap.min.css" rel="stylesheet">
    
    <!-- not use this in ltr -->
    <link href="css/rtl/bootstrap.rtl.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/rtl/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	
  <link href="css/plugins/social-buttons.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/jquery.plugin.js"></script>
    <!--<script src="js/jquery.calendars.all.js"></script><!-- Use instead of calendars, plus, and picker below -->
    <script src="js/jquery.calendars.js"></script>
    <script src="js/jquery.calendars.plus.js"></script>
    <script src="js/jquery.calendars.picker.js"></script>
    <!--<script src="js/jquery.calendars.picker.ext.js"></script><!-- Include for ThemeRoller styling -->
    <script src="js/jquery.calendars.islamic.js"></script>
    <link rel="stylesheet" href="css/jquery.calendars.picker.css" id="theme">

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
</head>
<body>

<p><span class="demoLabel">&nbsp;</span>
<p><span class="demoLabel">Popup datepicker (input):</span>
    <input id="popupDatepicker" size="10">&nbsp;
    <button type="button" class="disablePicker">Disable</button></p>
<p>

<?php
include("layout/footer.php") ;
?>