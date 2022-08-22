<?php
include("header.php");
?>
<?php
if($row['role'] != 'Administrator' )
{
  ?>
                <script>
				alert('Not allowed to you to enter this page ...');
				window.location.href='home.php';
				</script>
   <?php
}
   else{
        }
?>
<?php
$sql="UPDATE users SET ntf=1 WHERE ntf=0";	
$result=mysqli_query($con, $sql);
?>


<section role="main" class="content-body">
	<header class="page-header">
		<h2>Add User</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="home.php">
				    <i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Add New User</span></li>
			</ol>
			<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>


        <!-- start: page -->
		<div class="row" align="center">
			<div class="col-md-6 col-lg-12 col-xl-6">
				<section class="panel" >
	
	
<?php
 //including the database connection file
	require_once 'dbcon.php';
 $msg = "";
 if(isset($_POST['btnsave'])) 
 {   
    $account = mysqli_real_escape_string($con, $_POST['account']);
    $action = mysqli_real_escape_string($con, $_POST['action']);


            
        //insert data to database 
        $result = mysqli_query($con, "INSERT INTO logs(account,action,created) VALUES('$account','$action',now()) ");
       
       if( mysqli_errno($con)==0)
          {
           }
        else
             $msg =  "error number:" .mysqli_errno($con)."<br/> message:".mysqli_error($con);
    }
?>



<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	
	if(isset($_POST['btnsave']))
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO users(fname,lname,email,phone,password,role,created) VALUES(:ufname, :ulname,:uemail, :uphone, :upassword, :urole, now())');
			$stmt->bindParam(':ufname',$fname);
			$stmt->bindParam(':ulname',$lname);
			$stmt->bindParam(':uemail',$email);
			$stmt->bindParam(':uphone',$phone);
			$stmt->bindParam(':upassword',$password);
			$stmt->bindParam(':urole',$role);
			
			if($stmt->execute())
			{ 
				$successMSG = "User Added Successfully ...";
				
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}

	}

?>



	
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

    	<h1 class="h2">Add New User <a class="btn btn-default" href="userview.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all Users </a></h1>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	<tr>
    	<td><label class="control-label">First name.</label></td>
        <td><input class="form-control" type="text" name="fname" placeholder="Enter First name" /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Last name.</label></td>
        <td><input class="form-control" type="text" name="lname" placeholder="Enter Last name" /></td>
    </tr>

    <tr>
    	<td><label class="control-label">E-mail.</label></td>
        <td><input class="form-control" type="email" name="email" placeholder="Enter E-mail"/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Phone.</label></td>
        <td><input class="form-control" type="text" name="phone" placeholder="Enter Phone number" /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Password.</label></td>
        <td><input class="form-control" type="text" name="password" placeholder="Enter password"/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Role.</label></td>
        <td><select  name="role" id="role" class="form-control input-md">
                <option>Customer</option>
                <option>Vendor</option>
                <option>Administrator</option>
            </select>
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Add User
        </button>
        </td>
    </tr>
    
    </table>
<input class="form-control" type="text" name="account" value="<?php echo $row['email']; ?>" style="visibility:hidden" readonly/>
<input class="form-control" type="text" name="action" value="Add New User " style="visibility:hidden" readonly/>    
</form>

                    </div>
                    </div>

                </section>
   


<?php
include("footer.php");
?>




