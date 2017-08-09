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
                          <th>Session ID</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <form action="session.php" method="post">      
                        <?php 

                            $sessionquery= 'select * from sessiontbl';
                            $sessionresult = mysqli_query($connection,$sessionquery);
                            while($sessionrow = mysqli_fetch_assoc($sessionresult))
                            {

                        ?>

                        <tr>
                              <th scope="row"><?php echo $sessionrow['sessionid']; ?></th>
                              <td><?php echo $sessionrow['startsession']; ?></td>
                              <td><?php echo $sessionrow['endsession']; ?></td>
                              <td>
                                
                                    <input type="radio" name="sessionradio" <?php if($sessionrow['currentsession']==1) {echo "checked";} ?>  value="<?php echo $sessionrow['sessionid']?>">
                                
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
        $sessionid=$_POST['sessionradio'];
        $sessionquery1=" update sessiontbl set currentsession = '0' where not sessionid = '$sessionid' ";
        $sessionresult1=mysqli_query($connection,$sessionquery1);
        $sessionquery2=" update sessiontbl set currentsession = '1' where sessionid = '$sessionid' ";
        $sessionresult2=mysqli_query($connection,$sessionquery2);
        header('Location: session.php');
    }
   ?>
