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


                


                <form action="addnew.php" class="addnewform" method="post">
                    <fieldset> 
                      <legend><h3>Student Details</h3></legend> 
                      <div class="form-group">
                        <label for="admno">Admission Number</label>
                        <input type="text" class="form-control" id="admno" name="admno" value="" placeholder="Enter Admission Number!">
                      </div>
                      <div class="form-group">
                        <label for="rollno">Roll Number</label>
                        <input type="text" class="form-control" id="rollno" name="rollno" value="" placeholder="Enter Roll Number!">
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter Name of the Student!">
                      </div>
                      <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" class="form-control" id="dob" name="dob" value="" placeholder="Enter the Date of Birth!">
                      </div>
                      <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="classid">Class</label>
                        <select class="form-control" id="classid" name="classid">
                        <?php 

                            include '../includes/db.php';
                            $classquery="select * from classtbl";
                            $classresult=mysqli_query($connection,$classquery);
                            if(!$classresult)
                            {
                                echo "Not working";
                            }
                            while($classrow = mysqli_fetch_assoc($classresult))
                            {

                        ?>
                        
                            <option  value="<?php  echo $classrow['classid'] ?>"><?php echo $classrow['class']."-".$classrow['section'] ?></option>

                        <?php } ?>
                        </select>
                      </div>



                      <div class="form-group">
                        <label for="house">House</label>
                        <select class="form-control" id="house" name="house">
                          <?php

                            include '../includes/db.php';
                            $housequery = "select * from house";
                            $houseresult = mysqli_query($connection,$housequery);
                            if(!$houseresult)
                            {
                                die ("Error: ");
                            }
                            while($houserow = mysqli_fetch_assoc($houseresult))
                            {

                          ?>

                            <option  value="<?php echo $houserow['id'] ?>" ><?php echo $houserow['housename'] ?></option>

                          <?php } ?>
                        </select>
                      </div>


                      <div class="form-group">
                        <label for="quarterid">Quarter</label>
                        <select class="form-control" id="quarterid" name="quarterid">
                          <?php

                            include '../includes/db.php';
                            $quarterquery = "select * from quartertbl";
                            $quarterresult = mysqli_query($connection,$quarterquery);
                            if(!$quarterresult)
                            {
                                die ("Error: ");
                            }
                            while($quarterrow = mysqli_fetch_assoc($quarterresult))
                            {

                          ?>

                            <option value="<?php echo $quarterrow['quarterid'] ?>" ><?php echo $quarterrow['quarterstart']."-".$quarterrow['quarterend'] ?></option>

                          <?php } ?>
                        </select>
                      </div>


                      <div class="form-group">
                        <label for="schoolid">School Name</label>
                        <select class="form-control" id="schoolid" name="schoolid">
                            <?php 
                                include '../includes/db.php';
                                $schoolquery = 'select * from schooltbl';
                                $schoolresult = mysqli_query($connection,$schoolquery); 
                                if(!$schoolresult)
                                {
                                    die ('Error: ');
                                }
                                while($schoolrow = mysqli_fetch_assoc($schoolresult))
                                {
                            ?>
                                <option value="<?php echo $schoolrow['schoolid'] ?>"><?php echo $schoolrow['name'] ?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="sessionid">Session</label>
                        <select class="form-control" id="sessionid" name="sessionid">
                            <?php

                            include '../includes/db.php';
                            $sessionquery = "select * from sessiontbl";
                            $sessionresult= mysqli_query($connection,$sessionquery); 
                            if(!$sessionresult)
                            {
                                die ("Error: ");
                            }
                            while($sessionrow = mysqli_fetch_assoc($sessionresult))
                            {
                            ?>
                                <option value="<?php echo $sessionrow['sessionid']; ?>" ><?php echo $sessionrow['startsession']."-".$sessionrow['endsession']; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary" name="submit">Add Student!</button>
                    </fieldset>
                </form>




                <?php

                    if(isset($_POST['submit']))
                    {
                        include '../includes/db.php';
                        
                        $admno = $_POST['admno'];
                        $rollno = $_POST['rollno'];
                        $name = $_POST['name'];
                        $dob = $_POST['dob'];
                        $gender = $_POST['gender'];
                        $classid = $_POST['classid'];
                        $house = $_POST['house'];
                        $quarterid = $_POST['quarterid'];
                        $schoolid = $_POST['schoolid'];
                        $sessionid = $_POST['sessionid'];

                        $insertquery= "insert into studenttbl (`admno`,`rollno`,`name`,`dob`,`gender`,`classid`,`house`,`quarterid`,`schoolid`,`sessionid`) values ('$admno', '$rollno','$name','$dob','$gender','$classid','$house','$quarterid','$schoolid','$sessionid')" ;
                        
                          
                        $insertresult = mysqli_query($connection,$insertquery);
                        if($connection->error)
                        {
                            die( "Error: ".$connection->error);
                        }
                        //echo $updatequery;



                        

                        header("Refresh:0; url=students.php");

                        echo "<script>alert('Student Added!')</script>";

                        
                    }


                ?>

                


           

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include 'includes/footer.php' ?> 
