
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
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Edit user</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="Home.php">
				    <i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Edit User</span></li>
			</ol>
			<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>


        <!-- start: page -->
		<div class="row" align="center">
			<div class="col-md-6 col-lg-12 col-xl-6">
				<section class="panel" >
					<div class="panel-body">
					<div class="row">
            
<?php
 //including the database connection file
	require_once 'dbcon.php';
 $msg = "";
 if(isset($_POST['btn_save_updates'])) 
 {   
    $account = mysqli_real_escape_string($con, $_POST['account']);
    $action = mysqli_real_escape_string($con, $_POST['action']);


            
        //insert data to database 
        $result = mysqli_query($con, "INSERT INTO logs(account,action,created) VALUES('$account','$action',now())");
       
       if( mysqli_errno($con)==0)
          {
           }
        else
             $msg =  "error number:" .mysqli_errno($con)."<br/> message:".mysqli_error($con);
    }
?>

<?php

	error_reporting( ~E_NOTICE );
	
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: userview.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
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
			$stmt = $DB_con->prepare('UPDATE users 
									     SET fname=:ufname, 
									         lname=:ulname,
										     email=:uemail,
										     phone=:uphone, 
										     password=:upassword,
										     role=:urole,
										     updated=now() 
								       WHERE id=:uid');
			$stmt->bindParam(':ufname',$fname);
			$stmt->bindParam(':ulname',$lname);
			$stmt->bindParam(':uemail',$email);
			$stmt->bindParam(':uphone',$phone);
			$stmt->bindParam(':upassword',$password);
			$stmt->bindParam(':urole',$role);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='userview.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>








    	<h1 class="h2">Edit User<a class="btn btn-default" href="userview.php"> View All Users </a></h1>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    

    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
	
   
    
	<table class="table table-bordered table-responsive">
	<tr>
    	<td><label class="control-label">First name.</label></td>
        <td><input class="form-control" type="text" name="fname" value="<?php echo $fname; ?>" required/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Last name.</label></td>
        <td><input class="form-control" type="text" name="lname" value="<?php echo $lname; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">E-mail.</label></td>
        <td><input class="form-control" type="email" name="email" value="<?php echo $email; ?>" required/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Phone.</label></td>
        <td><input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>" required/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Password.</label></td>
        <td><input class="form-control" type="text" name="password" value="<?php echo $password; ?>" required/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Role.</label></td>
        <td><select  name="role" id="role" class="form-control input-md">
        	    <option><?php echo $role; ?></option>
                <option>Customer</option>
                <option>Vendor</option>
                <option>Administrator</option>
            </select>
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="userview.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    </table>
<input class="form-control" type="text" name="account" value="<?php echo $row['email']; ?>" style="visibility:hidden" readonly/>
<input class="form-control" type="text" name="action" value="Edit User" style="visibility:hidden" readonly/>    
</form>

                    </div>
                    </div>

                </section>
            </div>
        </div>
</section>


<?php
include("footer.php");
?>














