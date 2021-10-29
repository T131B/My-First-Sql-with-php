<?php
$host= "localhost";
$user="root";
$password="";
$dbName="crud";

 $conn = mysqli_connect($host,$user,$password,$dbName);
 ####################################################################
 ########Insert########################
 if(isset($_POST['send'])){
     $name = $_POST['userName'];
      $salary = $_POST['salary'];
      $insert = "INSERT INTO users values (NULL, '$name', $salary)";
     $i = mysqli_query($conn, $insert);
     if($i){
         echo "True insert";
        }else{
         echo "False insert";
        }
   }
//    ###############################################Selsct
   $selsct = "SELECT * FROM users";
   $s = mysqli_query($conn, $selsct);

   ###########Update#########
   $name="";
   $salary="";
   $update= false;
   if(isset($_GET['edit'])){
       $update=true;
       $id = $_GET['edit'];
       $selsct = "SELECT * FROM users where id = $id";
       $ss = mysqli_query($conn, $selsct);
       $row = mysqli_fetch_assoc($ss);
       $name = $row['name'];
       $salary = $row['salary'];


       if(isset($_POST['update'])){
        $name = $_POST['userName'];
        $salary = $_POST['salary'];
        $update = "UPDATE users SET name ='$name', salary = $salary where id =$id";
       $u = mysqli_query($conn, $update);
       if($u){
           echo "True update$update";
           header("location: /crud/index.php");
          }else{
           echo "False update$update";
          }

       }
   }
   #########delete

   if(isset($_GET['delete'])){
     $id = $_GET['delete'];
     $delete = "DELETE FROM users where id= $id";
      mysqli_query($conn, $delete);
     header("location: /crud/index.php");

   }


?>


<!-- =======start my page=========== -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY First php project with sql</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="/crud/main.css">

</head>
<body>
    <div class="container text-center col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <labele>user Name </labele>
                        <input type="text" value="<?php echo $name ?>" name = "userName" placeholder= "User Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <labele>user Salary </labele>
                        <input type="text" value="<?php echo $salary ?>" name = "salary" placeholder= "User Salary" class="form-control">
                    </div>
                    <?php if($update) : ?>
                    <button name = "update" class="btn btn-secondary"> Update Data </button>
                    <?php else: ?>
                    <button name = "send" class="btn btn-primary"> Send Data </button>
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>


    <div class="container text-center col-md-6 mt-3">
        <div class="card">  
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php  foreach($s as $data){ ?>
                    <tr>
                        <th> <?php echo $data['id'] ?> </th>
                        <th> <?php echo $data['name'] ?> </th>
                        <th> <?php echo $data['salary'] ?> </th>
                        <th><a href= "/crud/index.php?edit=<?php echo $data['id'] ?>" class= "btn btn-info"> Edit</a>   </th>
                        <th><a href= "/crud/index.php?delete=<?php echo $data['id'] ?>" class= "btn btn-danger"> Delete</a>   </th>
                    </tr>
                    <?php }?>    
                </table>
            </div>
        </div>
    </div> 

</body>
</html>