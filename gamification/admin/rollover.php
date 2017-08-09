<?php include '../includes/db.php' ?>
<?php session_start(); 

if(!isset($_SESSION['user']))
{
    header('location: ../form.php');
}

?>

<?php

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
  return $row['class']."-".$row['section'];
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
                        <legend><h3>Roll Over!</h3></legend>
                        <div class="col-lg-12 filter-pos">


                            <div class="form-group" style="width: 45% ; float: left">

                              <label for="classid">Current Class</label>
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
                            
                          <div class="form-group" style="width: 45% ; float: left; margin-left: 5%">

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

                                <button type="submit" class="btn btn-primary" name="search">Search Class!</button>



                          </div>
                          


                        </div>
                      

                  
                </div>




                <?php

                    
                    if(isset($_POST['search']))
                    {
                        include '../includes/db.php';
                        $selectschoolid= $_POST['schoolid'];
                        $selectclassid = $_POST['classid'];
                        
                        $query= "select admno,name,classid from studenttbl where schoolid = '$selectschoolid' and classid = '$selectclassid' ";
                        
                        
                        $result= mysqli_query($connection,$query);
                        if(!$result)
                        {
                          echo "not working";
                        }
                        
                      $i=1;


                ?>


                
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Admission Number</th>
                      <th>Name</th>
                      <th>Class</th>
                      <th>Promote</th>
                    </tr>
                  </thead>
                  <tbody>
                
               <?php
                        while($row = mysqli_fetch_assoc($result))
                        {

                          
                ?>


                   <tr>
                      <th scope="row"><?php echo $row['admno']; ?></th>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo findclassfilter($row['classid']); ?></td>
                      <td><input type="checkbox" name="<?php echo 'pass'.$i ?>" value="<?php  echo $row['admno']; ?>"  checked ><input type='hidden' name='noofstu' value='<?php echo $i ?>'/></td>
                    </tr>
                    
                  



                <?php
                      $i++;
                        }

                ?>

                        <div class="form-group">

                              <label for="classid">Update Class</label>
                              <select class="form-control" id="classupdateid" name="updateclassid">
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


                            </tbody>
                </table>




              <?php
                      }
                    
                ?>

                

                
               
                <div class="form-group">

                    <button type="submit" class="btn btn-primary" name="promote" style="margin-left: 15px; ">Promote Students!</button>



                </div>
              </fieldset>
            </form>

              <?php


                  if(isset($_POST['promote']))
                  {
                    include '../includes/db.php';
                    // check the current session
                    $admno=$_POST['pass1'];
                    $studentquery="select sessionid from studenttbl where admno = '$admno' ";
                    $sessionquery="select sessionid from sessiontbl where currentsession = '1' ";

                    $result=$connection->query($studentquery);

                    if($connection->error)
                    {
                      die("Error".$connection->error);
                    }
                    $data=$result->fetch_assoc();
                    

                    $result=$connection->query($sessionquery);
                    $data2=$result->fetch_assoc();
                    

                    /*$studentresult=mysqli_query($connection,$studentquery);
                    $sessionresult=mysqli_query($connection,$sessionquery);
                    $studentrow=mysqli_fetch_assoc($studentresult);
                    $sessionrow=mysqli_fetch_assco($sessionresult);
                    echo $studentrow['sessionid'];*/

                    if($data == $data2)
                    {
                      echo "change the session";
                    }
                    else{
                      $i=$_POST['noofstu'];
                      for($j=1;$j<=$i;$j++)
                      {
                        if(isset($_POST['pass'.$j]))
                          {
                            $admno=$_POST['pass'.$j];
                            $updateclassid=$_POST['updateclassid'];
                            $classquery= "update studenttbl set classid= '$updateclassid' where admno = '$admno' ";
                            $classresult=mysqli_query($connection,$classquery);
                          }
                      }
                    }

                    
                  }


              ?>
            









            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include 'includes/footer.php' ?> 
   
    
