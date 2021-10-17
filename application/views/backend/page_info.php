<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title;?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="http://nhssnellimood.com/" target="_blank" class="btn btn-info btn-sm pull-right m-l-20 btn-rounded hidden-xs hidden-sm waves-effect waves-light">School website</a>
                        <ol class="breadcrumb">
                            <li><a href=""><?php echo $system_name;?></a></li>
                            <li class="active"><?php date_default_timezone_set('Asia/Kolkata'); 
                           ?></li>
                            <li id="timeNow" class="active"></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <script>
    function getTime(){
        var today = new Date();
        var day = today.getDate();
        day = checkTime(day);
        var month = today.getMonth()+1;
        month = checkTime(month);
        var year = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        m = checkTime(m);
        var s = today.getSeconds();
        s = checkTime(s);
        var daySep = '-';
        var timeSep = ':';
        document.getElementById("timeNow").innerHTML = day + daySep + month + daySep + year + ' ' + h + timeSep + m + timeSep + s;
        var intervalId = window.setInterval(function(){
            getTime();
        }, 1000);
    }
    getTime();
    function checkTime(i) {
        if (i < 10) {
            i = "" + i;
        }
    return i;
    }
</script>