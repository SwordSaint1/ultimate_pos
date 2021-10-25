
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY | POS</title>
    <link rel="stylesheet" type="text/css" href="../node_modules/materialize-css/dist/css/materialize.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../main.css"> -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <style type="text/css">
         .scrollit {
    overflow:scroll;
    height:400px;
}
     </style>
</head>
<body>
<h5 class="header center" style="font-family:courier;">My|POS</h5>
<!-- SIDENAV -->
<ul id="slide-out" class="sidenav ">

        
    <li> <a href="requestor.php" class="collection-item active  blue darken-3"> <i class="material-icons">content_paste</i> Training Request</a></li>
    <li><a href="#" class="collection-item modal-trigger" data-target="modal-logout"><i class="material-icons">settings_power</i> Logout</a></li>
 

</ul>

<div class="row">
    <a href="#" class="sidenav-trigger blue darken-3 btn-small hide-on-med-and-up" data-target="slide-out"><i class="large material-icons ">menu</i></a>
    <!-- SIDE -->
    <div class="col l2 m3 z-depth-5">
        <div class="row hide-on-small-only">
            <div class="center">
            <img src="../image/logo.png" class="responsive-img" height="100" width="100">
        
            
        </div>
            <div class="center">
                <h5>Dashboard</h5>
            </div>
            <br>
            <div class="row"  style="min-height:55vh;">
                <div class="collection col l12 m12">

                    <a href="dashboard.php" class="collection-item active  blue darken-3"><i class="material-icons">laptop</i> POS</a>

                    <a href="order.php" class="collection-item"><i class="material-icons">content_paste</i> Orders</a>

                       <a href="menu.php" class="collection-item"><i class="material-icons">import_contacts</i> Menu</a>

                       <a href="expenses.php" class="collection-item"><i class="material-icons">monetization_on</i> Expenses</a>

                        <a href="sales_report.php" class="collection-item"><i class="material-icons">show_chart</i> Sales Report</a>
                   
                    <a href="#" class="collection-item modal-trigger" data-target="modal-logout"><i class="material-icons">settings_power</i> Logout</a>
                </div>
            </div>
            
                
            
        </div>
    </div>
    
    
<div class="divider">
    
</div>

<br>

    <!-- CONTAINER -->


    <div class="col l10 m9 s12">
        <div class="row">
                    <div class="col s12">
                        <div class="input-field col s12">
                        
                            <nav class="nav-extended #1565c0 blue darken-3 z-depth-5">
  
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a href="#request">POS</a></li>
      </ul>
    </div>
  </nav>
                        </div>
                
            <!-- tab links -->

<div id="request"><?php include'POS/pos_tab.php'?></div>

                    </div>
                </div>
                <!-- TABLE------------------------------------------------------------------------------------------------- -->
            
        </div>
    </div>
</div>
</div>

<!-- MODALS -->
<?php

?>

<!-- JS -->
    
<script type="text/javascript" src="../node_modules/materialize-css/dist/js/materialize.min.js"></script>
<script type="text/javascript" src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.modal').modal({
            inDuration: 300,
            outDuration: 300
        });
        $('.sidenav').sidenav();
         $('.tabs').tabs();
   
     $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoClose:true
     });

     $('select').formSelect();
     load_order();
    });





</script>
</body>
</html>

