
<?php
include("header.php");
?>
<?php
if($row['role'] != 'Vendor' )
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
		<h2>Edit This Offer</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="Home.php">
				    <i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Edit Offer</span></li>
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
		$stmt_edit = $DB_con->prepare('SELECT * FROM offers WHERE id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: venoffers.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$product = $_POST['product'];
		$speciality = $_POST['speciality'];
		$price = $_POST['price'];
		$availability = $_POST['availability'];
			
		$imgFile = $_FILES['img']['name'];
		$tmp_dir = $_FILES['img']['tmp_name'];
		$imgSize = $_FILES['img']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'img/users/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$imgpic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['img']);
					move_uploaded_file($tmp_dir,$upload_dir.$imgpic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$imgpic = $edit_row['img']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE offers 
									     SET product=:uproduct, 
									         speciality=:uspeciality,
										     price=:uprice,
										     availability=:uavailability, 
										     img=:uimg,
										     updated=now() 
								       WHERE id=:uid');
			$stmt->bindParam(':uproduct',$product);
			$stmt->bindParam(':uspeciality',$speciality);
			$stmt->bindParam(':uprice',$price);
			$stmt->bindParam(':uavailability',$availability);
			$stmt->bindParam(':uimg',$imgpic);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='venoffers.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>








    	<h1 class="h2">Edit Offer <a class="btn btn-default" href="venoffers.php"> all Offers </a></h1>

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
    	<td><label class="control-label">Product name.</label></td>
        <td><input class="form-control" type="text" name="product" value="<?php echo $product; ?>" required /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product speciality.</label></td>
        <td><select  name="speciality" id="speciality" class="form-control input-md" value="<?php echo $speciality; ?>">
                <option ><?php echo $speciality;?></option>
                <option>Heart</option>
                <option>Chest</option>
            </select></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Price per one.</label></td>
        <td><input class="form-control" type="text" name="price" value="<?php echo $price; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Stock availability.</label></td>
        <td><input class="form-control" type="text" name="availability" value="<?php echo $availability; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Product image.</label></td>
        <td>
        	<p><img src="img/users/<?php echo $img; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="img" accept="image/*" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="venoffers.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
<input class="form-control" type="text" name="account" value="<?php echo $row['email']; ?>" style="visibility:hidden" readonly/>
<input class="form-control" type="text" name="action" value="Update his offer" style="visibility:hidden" readonly/>    
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














