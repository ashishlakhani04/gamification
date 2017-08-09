<?php include '../includes/db.php' ?>
<?php session_start(); 

if(!isset($_SESSION['user']))
{
    header('location: ../form.php');
}

function findclass($id){
  include '../includes/db.php';
  $sql="select * from classtbl where classid ='".$id."'";

  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  echo $row['class']."-".$row['section']; 

}
function findhouse($house){
  include '../includes/db.php';
  $sql= "select * from house where id = '$house' ";
  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  echo $row['housename'];
}
function findschool($school){
  include '../includes/db.php';
  $sql= "select * from schooltbl where schoolid = '$school' ";
  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  echo $row['name'];
}
function findsession($session){
  include '../includes/db.php';
  $sql= "select * from sessiontbl where sessionid = '$session' ";
  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  echo $row['startsession'].'-'.$row['endsession'];
}
function findquarter($quarter){
  include '../includes/db.php';
  $sql= "select * from quartertbl where quarterid = '$quarter' ";
  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  echo $row['quarterstart'].'-'.$row['quarterend'];
}
function findclassfilter($classid)
{
  include '../includes/db.php';
  $sql= "select * from classtbl where classid = '$classid' ";
  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  return $row['class'];
}
function findhousefilter($houseid)
{
  include '../includes/db.php';
  $sql= "select * from house where id = '$houseid' ";
  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  return $row['housename'];
}
function findschoolfilter($schoolid)
{
  include '../includes/db.php';
  $sql= "select * from schooltbl where schoolid = '$schoolid' ";
  $result=$connection->query($sql);

  if($connection->error)
  {
    echo $connection->error;
  }
  $row=$result->fetch_assoc();
  return $row['name'];
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

                    <form class="filter" method="post">
                      <fieldset>
                        <legend><h3>Filter your Search</h3></legend>
                        <div class="col-lg-12 filter-pos">

                            <div class="form-group" style="width: 45% ; float: left;">
                                <label for="admno">Admission Number</label>
                                <input type="text" class="form-control" id="admno" name="admno" value="" placeholder="Search by Admission">
                            </div>

                            <div class="form-group" style="width: 45% ; float: left ;margin-left: 5%;">

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
                          
                              <option <?php if($classrow['class'] == 'None') { echo 'selected'; } ?> value="<?php  echo $classrow['classid'] ?>"><?php echo $classrow['class']."-".$classrow['section'] ?></option>

                              <?php } ?>
                              </select>

                            </div>
                          <div class="form-group" style="width: 45% ; float: left;">

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

                            <option <?php if($houserow['housename'] == 'None'){ echo 'selected'; } ?> value="<?php echo $houserow['id'] ?>" ><?php echo $houserow['housename'] ?></option>

                            <?php } ?>
                            </select>
                            
                          </div>
                          <div class="form-group" style="width: 45% ; float: left; margin-left: 5%;">

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
                                <option <?php if($schoolrow['name'] == 'None'){ echo 'selected'; } ?>  value="<?php echo $schoolrow['schoolid'] ?>"><?php echo $schoolrow['name'] ?></option>
                              <?php } ?>
                            </select>
                            
                          </div>

                          <div class="form-group">

                                <button type="submit" class="btn btn-primary" name="search">Search Filters!</button>



                          </div>
                          <div class="form-group">

                                <button type="submit" class="btn btn-primary" name="addnew">Add New Student!</button>



                          </div>


                        </div>
                      </fieldset>
                    </form>

                  
                </div>

                <?php 

                  if(isset($_POST['addnew']))
                  {

                    header('Location: addnew.php');

                  }


                ?>



                <?php if(isset($_POST['search'])) { 
                  include '../includes/db.php' ;

                  $filteradmno = $_POST['admno'];
                  $filterclassid = $_POST['classid'];
                  $filterhouse = $_POST['house'];
                  $filterschoolid = $_POST['schoolid'];

                  

                  
                  $a = " select * from studenttbl  ";

                  $b = "";

                  $num=0;
                  if($filteradmno != "" && $num==0)
                  {
                    $b = $b . " where admno='$filteradmno' ";
                    $num=1;
                  }
                  
                  
                  if(findclassfilter($filterclassid) != 'None' && $num==0)
                  {
                    $b = " where classid= '$filterclassid'  ";
                    $num=1;
                  }
                  elseif(findclassfilter($filterclassid) != 'None')
                  {
                    $b = $b . " && classid= '$filterclassid'  ";
                  }
                    
                  if(findhousefilter($filterhouse) != 'None' && $num==0)
                  {
                    $b = " where house = '$filterhouse' ";
                    $num=1;
                  }
                  elseif(findhousefilter($filterhouse) != 'None')
                  {
                    $b=$b . " && house = '$filterhouse' ";
                  }
                      
                  if(findschoolfilter($filterschoolid) != 'None' && $num==0)
                  {
                    $b = " where schoolid = '$filterschoolid' ";
                  }
                  elseif(findschoolfilter($filterschoolid) != 'None')
                  {
                    $b = $b . " && schoolid = '$filterschoolid' ";
                  }
                  $sql = $a . $b;
                  
                  
                    
                  

                ?>

                 <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Admission Number</th>
                          <th>Roll Number</th>
                          <th>Name</th>
                          <th>Date of Birth</th>
                          <th>Gender</th>
                          <th>Class</th>
                          <th>House</th>
                          <th>Quarter</th>
                          <th>School Name</th>
                          <th>Session</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      


                        <?php 

                          include '../includes/db.php' ;

                          
                          
                          $classquery='select * from classtbl';

                          $result = mysqli_query($connection,$sql);

                          $classresult = mysqli_query($connection,$classquery);

                          if(!$result || !$classresult)
                          {
                            die ("Error".$connection.error());
                          }

                          while($row=$result->fetch_assoc())

                          {


                        ?>
                      <tr>

                          <?php $id=$row['id'] ; ?>

                          <th scope="row"><?php echo $row['admno'] ?></th>
                          <td><?php echo $row['rollno']; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['dob']; ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php findclass($row['classid']); ?></td>
                          <td><?php findhouse($row['house']); ?></td>
                          <td><?php findquarter($row['quarterid']); ?></td>
                          <td><?php findschool($row['schoolid']); ?></td>
                          <td><?php findsession($row['sessionid']); ?></td>
                          <?php
                          echo "<td>";
                          echo "<a href='edit.php?id=".$id."'>Edit </a>"."/"."<a href='delete.php?id=".$id."'> Delete</a>";
                          echo "</td>";
                          ?>

                      </tr>

                <?php } ?>

                
                    
                      
                          
                        
                        
                      </tbody>
                    </table>


           

                    <?php } ?>







            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include 'includes/footer.php' ?> 
