
<?php include 'includes/db.php' ; ?>

<?php include 'includes/header.php' ; ?>

    <!-- Navigation -->

    <?php include 'includes/navigation.php' ; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


<?php 

if(isset($_POST['submit']))
{

    $teacherName = $_POST['name'];

    $teacherEmail = $_POST['email'];

    $teacherPass = $_POST['password'];

    $query = "select * from teachertbl where email = '$teacherEmail' and password = '$teacherPass' ";

    //$result = mysqli_query($connection,$query);
    
    $result=$connection->query($query);

    
    if(!$result)
    {
        echo "query failed".$connection->error;
    }
    echo "HEllo";

    if($result->num_rows)
    {
      session_start();
      $_SESSION["user"] = $teacherName;
      header("location: admin/index.php");
    }
    echo"Wrong Credentials";



}




?>




                
  

  <form method="post" action="">

  <fieldset>

    <legend><h2>Login</h2></legend>

    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
      </div>
    </div>


    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
      </div>
    </div>


    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
      </div>
    </div>
   
    
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10" style="float: right;">
        <button type="submit" class="btn btn-primary btn-lg" name="submit" style="float: right;">Sign in</button>
      </div>
    </div>

    </fieldset>
  </form>


                
            </div>

            <!-- Blog Sidebar Widgets Column -->


            <?php include 'includes/sidebar.php' ?>



        </div>



        <!-- /.row -->

        <hr>

        <!-- Footer -->
        
        <?php include 'includes/footer.php' ?>
