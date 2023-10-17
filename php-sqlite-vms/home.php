<h1 class="text-center fw-bolder">Welcome to IMS Visitor Management System</h1>
<hr class="mx-auto opacity-100" style="width:50px;height:3px">
<?php 
$clogin = $_SESSION['type'];
require_once('DBConnection.php');
include_once("./Master.php");
?>
<!--<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card rounded-0 shadow dash-box">
            <div class="card-body">
                <div class="dash-box-icon">
                    <span class="material-symbols-outlined">groups</span>
                </div>
                <div class="dash-box-title">Visitors Today</div>
                <div class="dash-box-text"><?= $master->today_visitors() ?></div>
                <div style="text-align: right;"><a class=" <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=visitors">More Info</a></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card rounded-0 shadow dash-box">
            <div class="card-body">
                <div class="dash-box-icon">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <div class="dash-box-title">Unexited Visitors Today</div>
                <div class="dash-box-text"><?= $master->today_visitors_not_exited() ?></div>
                <div style="text-align: right;"><a class=" <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=unexited_visitors">More Info</a></div>
            
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card rounded-0 shadow dash-box">
            <div class="card-body">
                <div class="dash-box-icon">
                    <span class="material-symbols-outlined">logout</span>
                </div>
                <div class="dash-box-title">Exited Visitors Today</div>
                <div class="dash-box-text"><?= $master->today_visitors_exited() ?></div>
                <div style="text-align: right;"><a class=" <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=exited_visitors">More Info</a></div>
            
            </div>
        </div>
    </div>
    <hr>
    <h2>Second Floor</h2>
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card rounded-0 shadow dash-box">
            <div class="card-body">
                <div class="dash-box-icon">
                    <span class="material-symbols-outlined">Domain</span>
                </div>
                <div class="dash-box-title">Visitors Today</div>
                <div class="dash-box-text"><?= $master->second_today_visitors() ?></div>
                <div style="text-align: right;"><a class=" <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=secondvisitors">More Info</a></div>
            
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card rounded-0 shadow dash-box">
            <div class="card-body">
                <div class="dash-box-icon">
                    <span class="material-symbols-outlined">Apartment</span>
                </div>
                <div class="dash-box-title">Unexited Visitors Today</div>
                <div class="dash-box-text"><?= $master->second_visitors_not_exited() ?></div>
                <div style="text-align: right;"><a class=" <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=secondunexited_visitors">More Info</a></div>
            
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card rounded-0 shadow dash-box">
            <div class="card-body">
                <div class="dash-box-icon">
                    <span class="material-symbols-outlined">location_city</span>
                </div>
                <div class="dash-box-title">Exited Visitors Today</div>
                <div class="dash-box-text"><?= $master->second_visitors_exited() ?></div>
                <div style="text-align: right;"><a class=" <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=secondexited_visitors">More Info</a></div>
            
            </div>
        </div>
    </div>
--> 
<?php if($clogin == 2){?>
<div class="p-3 mb-2 bg-info text-white">
    <!-- <strong>User :: <?php echo $_SESSION['username']?></strong><br/> -->
    <strong>Floor No : <?php if(isset($_COOKIE['floornumberafterlogin'])){ echo $_COOKIE['floornumberafterlogin'];
    $floornumber=$_COOKIE['floornumberafterlogin'];} ?>  </strong> 

</div>

<br/><br/><br/>
<div class="jumbotron">
<div class="row w-100">
        <!-- <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-user" aria-hidden="true"></span></div>
                <div class="text-info text-center mt-3"><h4><a style=";text-decoration:none; background:;" class=" text-info<?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=visitors">All<br/> Visitors</a></h4></div>
                <div class="text-info text-center mt-2"><h1> <?php 
                        $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list` where `floornumber`={$floornumber}");
                       echo $total;
                    ?>  
                </h1></div>

            </div>
        </div> -->
        <div class="col-md-3">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-sign-in" aria-hidden="true"></span></div>
                <div class="text-success text-center mt-3"><h4><a style=";text-decoration:none; background:;" class=" text-success<?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=exited_visitors">Exited Visitors Today</a></h4></div>
                <div class="text-success text-center mt-2"><h1>
                    <?php 
                        $from = date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 00:00:00"));
                        $to =  date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 23:59:59"));
                        $from = new DateTime($from, new DateTimeZone('Asia/Kolkata'));
                        $from->setTimezone(new DateTimeZone('UTC'));
                        $from = $from->format("Y-m-d");
                        $to = new DateTime($to, new DateTimeZone('Asia/Kolkata'));
                        $to->setTimezone(new DateTimeZone('UTC'));
                        $to = $to->format("Y-m-d");
                        $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list`
                         where `currentstatus`='out'  AND `floornumber`={$floornumber} AND date(`date_created`) BETWEEN '{$from}' AND '{$to}'");
                       echo $total;
                     ?>



                </h1></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-sign-out" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4><a style=";text-decoration:none; background:;" class=" text-danger<?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=unexited_visitors">Unexited Visitors Today</a></h4></div>
                <div class="text-danger text-center mt-2"><h1> <?php 
                        $from = date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 00:00:00"));
                        $to =  date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 23:59:59"));
                        $from = new DateTime($from, new DateTimeZone('Asia/Kolkata'));
                        $from->setTimezone(new DateTimeZone('UTC'));
                        $from = $from->format("Y-m-d");
                        $to = new DateTime($to, new DateTimeZone('Asia/Kolkata'));
                        $to->setTimezone(new DateTimeZone('UTC'));
                        $to = $to->format("Y-m-d");
                        $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list`
                         where `currentstatus`='in'  AND `floornumber`={$floornumber} AND date(`date_created`) BETWEEN '{$from}' AND '{$to}'");
                       echo $total;
                     ?></h1></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-warning shadow text-warning p-3 my-card" ><span class="fa fa-user" aria-hidden="true"></span></div>
                <div class="text-warning text-center mt-3"><h4><a style=";text-decoration:none; background:;" class=" text-warning<?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=visitors">Visitors<br/>Today</a></h4></div>
                <div class="text-warning text-center mt-2"><h1>
                    <?php 
                    $from = date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 00:00:00"));
                    $to =  date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 23:59:59"));
                    $from = new DateTime($from, new DateTimeZone('Asia/Kolkata'));
                    $from->setTimezone(new DateTimeZone('UTC'));
                    $from = $from->format("Y-m-d");
                    $to = new DateTime($to, new DateTimeZone('Asia/Kolkata'));
                    $to->setTimezone(new DateTimeZone('UTC'));
                    $to = $to->format("Y-m-d");
                    $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list`
                     where  `floornumber`={$floornumber} AND date(`date_created`) BETWEEN '{$from}' and '{$to}'");
                    echo $total;
                ?>
                   </h1></div>
            </div>
        </div>
     </div>
</div>
</div>
<?php }else{ ?>
<div class="p-3 mb-2 bg-info text-white">
    <strong>User :: <?php echo $_SESSION['username']?></strong><br/>
 </div>
<br/><br/><br/>
<div class="jumbotron">
<div class="row w-100">
        <!-- <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-user" aria-hidden="true"></span></div>
                <div class="text-info text-center mt-3"><h4><a style=";text-decoration:none; background:;" class=" text-info<?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=visitors">All<br/> Visitors</a></h4></div>
                <div class="text-info text-center mt-2"><h1>
                    <?php 
                       
                        $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list`");
                       echo $total;
                    ?>  

                </h1></div>
            </div>
        </div> -->
        <div class="col-md-3">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-sign-in" aria-hidden="true"></span></div>
                <div class="text-success text-center mt-3"><h4><a style=";text-decoration:none; background:;" class="text-success <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=exited_visitors">Exited Visitors Today</a></h4></div>
                <div class="text-success text-center mt-2"><h1>
                    <?php 
                        $from = date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 00:00:00"));
                        $to =  date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 23:59:59"));
                        $from = new DateTime($from, new DateTimeZone('Asia/Kolkata'));
                        $from->setTimezone(new DateTimeZone('UTC'));
                        $from = $from->format("Y-m-d");
                        $to = new DateTime($to, new DateTimeZone('Asia/Kolkata'));
                        $to->setTimezone(new DateTimeZone('UTC'));
                        $to = $to->format("Y-m-d");
                        $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list`
                         where `currentstatus`='out' AND date(`date_created`) BETWEEN '{$from}' AND '{$to}'");
                       echo $total;
                     ?>


                </h1></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-sign-out" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4><a style=";text-decoration:none; background:;" class="text-danger <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=unexited_visitors">Unexited Visitors Today</a></h4></div>
                <div class="text-danger text-center mt-2"><h1>
                    <?php 
                        $from = date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 00:00:00"));
                        $to =  date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 23:59:59"));
                        $from = new DateTime($from, new DateTimeZone('Asia/Kolkata'));
                        $from->setTimezone(new DateTimeZone('UTC'));
                        $from = $from->format("Y-m-d");
                        $to = new DateTime($to, new DateTimeZone('Asia/Kolkata'));
                        $to->setTimezone(new DateTimeZone('UTC'));
                        $to = $to->format("Y-m-d");
                        $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list`
                         where `currentstatus`='in' AND date(`date_created`) BETWEEN '{$from}' AND '{$to}'");
                       echo $total;
                     ?>
                         
                     </h1></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-warning shadow text-warning p-3 my-card" ><span class="fa fa-user" aria-hidden="true"></span></div>
                <div class="text-warning text-center mt-3"><h4><a style=";text-decoration:none; background:;" class="text-warning <?php echo ($page == 'visitors')? 'active' : '' ?> " aria-current="page" href="./?page=visitors">Visitors<br/>Today</a></h4></div>
                <div class="text-warning text-center mt-2"><h1>
                 <?php 
                    $from = date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 00:00:00"));
                    $to =  date("Y-m-d h:i:s", strtotime(date("Y-m-d"). " 23:59:59"));
                    $from = new DateTime($from, new DateTimeZone('Asia/Kolkata'));
                    $from->setTimezone(new DateTimeZone('UTC'));
                    $from = $from->format("Y-m-d");
                    $to = new DateTime($to, new DateTimeZone('Asia/Kolkata'));
                    $to->setTimezone(new DateTimeZone('UTC'));
                    $to = $to->format("Y-m-d");
                    $total = $conn->querySingle("SELECT COUNT(`visitor_id`) FROM `visitor_list`
                     where date(`date_created`) BETWEEN '{$from}' and '{$to}'");
                    echo $total;
                ?></h1></div>
            </div>
        </div>
     </div>
</div>
</div>
<!--
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Floor</th>
      <th scope="col">Total Visitors</th>
      <th scope="col">Exited Visitors Today</th>
      <th scope="col">Unexited Visitors Today</th>
      <th scope="col"> Visitors Today</th>
      <th scope="col">More Info</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td class="text-info">Mark</td>
      <td class="text-success">Otto</td>
      <td class="text-danger">Mark</td>
      <td class="text-warning">Otto</td>
      <td class="text-"> @mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
       <td class="text-info">Mark</td>
      <td class="text-success">Otto</td>
      <td class="text-danger">Mark</td>
      <td class="text-warning">Otto</td>
      <td class="text-"> @mdo</td>
    </tr>
    <tr>
      <th scope="row">4</th>
       <td class="text-info">Mark</td>
      <td class="text-success">Otto</td>
      <td class="text-danger">Mark</td>
      <td class="text-warning">Otto</td>
      <td class="text-"> @mdo</td>
    </tr>
     <tr>
      <th scope="row">5</th>
       <td class="text-info">Mark</td>
      <td class="text-success">Otto</td>
      <td class="text-danger">Mark</td>
      <td class="text-warning">Otto</td>
      <td class="text-"> @mdo</td>
    </tr>
  </tbody>
</table>
-->

<?php } ?>