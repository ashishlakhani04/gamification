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

                


                <form>
                    
                     <div class="form-group">
                     <form method="get" action="gamification.php">
                        <div class="form-check">    
                            <label for="exampleSelect1">Select Class!</label>
                            <select class="form-control" id="exampleSelect1">

                            <?php include '../includes/db.php';

                                $query = "select * from classtbl";

                                $resultquery = mysqli_query($connection,$query);

                                while($resultrow = mysqli_fetch_assoc($resultquery))

                                {

                            ?>
                                <option value= "<?php echo $resultrow['classid'] ?>" ><?php echo $resultrow['class']."-".$resultrow['section'] ?></option>
                             
                             <?php } ?>

                            </select>
                        </div>


                        <div class="form-check paddingg" style="padding-top: 20px;">
                            <button type="submit" class="btn btn-primary" name="submit">Submit!</button>
                        </div>
                        
                        
                      </form>
                      </div>

                </form>
            


                    <?php include '../includes/db.php';

                            if(isset($_GET['submit']))
                            {
                                $query = "select * from studenttbl";
                                $resultquery = mysqli_query($connection,$query);
                                $i=0;
                                while($row = mysqli_fetch_assoc($resultquery))
                                {
                                    if($row['answer'] == '0')
                                    {
                                        $i++;
                                    }
                                }
                                
                                $num = rand(0,$i);
                                
                                $update = 0;
                                
                                $query = "select * from studenttbl where answer = '0' ";
                                $resultquery = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($resultquery))
                                {
                                    if($update == $num){

                                        echo '<div class="modal fade">';
                                        echo '<div class="modal-dialog" role="document">';
                                        echo '<div class="modal-content">';
                                        echo '<div class="modal-header">
                                                <h5 class="modal-title">Assessment!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>';

                                        echo '<div class="modal-body">';
                                                
                                        echo '<h1>'.$row['name'].'</h1>';

                                        echo '</div>';

                                        echo '<div class="modal-footer">';

                                        

                                        echo '
                            <button type="submit" class="btn btn-primary" name="right">Right Answer!</button>
                        ';

                                        echo '<div class="form-check data-dismiss="modal" paddingg" style="padding-top: 20px;">
                            <button type="submit" class="btn btn-primary" name="wrong">Wrong Answer!</button>
                        </div>';

                                        echo '</div>';
                                        
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                                  
                                    }
                                    
                                    $update++;
                                }
                            }

                            
                       ?>






            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include 'includes/footer.php' ?> 

   

