<?php include '../includes/db.php' ?>
<?php session_start(); 

if(!isset($_SESSION['user']))
{
    header('location: ../form.php');
}

?>

<?php include 'includes/header.php' ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Top Menu Items -->


            <?php include 'includes/topmenu.php' ?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            

            <?php include 'includes/sidemenu.php' ?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                            <small>By Nimesh</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                


                <div class="row col-lg-12">


                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Quarter ID</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Duration</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <form action="quarter.php" method="post">      
                        <?php 

                            $quarterquery= 'select * from quartertbl';
                            $quarterresult = mysqli_query($connection,$quarterquery);
                            while($quarterrow = mysqli_fetch_assoc($quarterresult))
                            {

                        ?>

                        <tr>
                              <th scope="row"><?php echo $quarterrow['quarterid']; ?></th>
                              <td><?php echo $quarterrow['quarterstart']; ?></td>
                              <td><?php echo $quarterrow['quarterend']; ?></td>
                              <td><?php echo $quarterrow['duration']; ?></td>
                              <td>
                                
                                    <input type="radio" name="quarterradio" <?php if($quarterrow['currentquarter'] == 1) {echo "checked";} ?>  value="<?php echo $quarterrow['quarterid']?>">
                                
                              </td>
                        </tr>


                        <?php } ?>
                           
                        <input type="submit" class="btn btn-primary" name="updatestatus" value="Update!">
                            
                        </form>
                      </tbody>
                    </table>
                    

                    
                </div>
            









            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include 'includes/footer.php' ?> 
   <?php 
    include '../includes/db.php';
    if(isset($_POST['updatestatus']))
    {

        $answerquery = "update studenttbl set answer = '0' ";
        $answerresult = mysqli_query($connection,$answerquery);
        
        $quarterid=$_POST['quarterradio'];
        $currentquery = "update studenttbl set quarterid = '$quarterid' ";
        $currentresult = mysqli_query($connection,$currentquery);
        $quarterquery1=" update quartertbl set currentquarter = '0' where not quarterid = '$quarterid' ";
        $quarterresult1=mysqli_query($connection,$quarterquery1);
        $quarterquery2=" update quartertbl set currentquarter = '1' where quarterid = '$quarterid' ";
        $quarterresult2=mysqli_query($connection,$quarterquery2);
        header('Location: quarter.php');
    }
   ?>
