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
		<h2>Add New Offer</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="home.php">
				    <i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Add Offer</span></li>
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
        $result = mysqli_query($con, "INSERT INTO logs(account,action,created) VALUES('$account','$action',now())");
       
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
		$email = $_POST['email'];
		$product = $_POST['product'];
		$speciality = $_POST['speciality'];
		$price = $_POST['price'];
		$availability = $_POST['availability'];

		
		
		$imgFile = $_FILES['img']['name'];
		$tmp_dir = $_FILES['img']['tmp_name'];
		$imgSize = $_FILES['img']['size'];
		
		
		if(empty($product)){
			$errMSG = "Please Enter product.";
		}
		else if(empty($speciality)){
			$errMSG = "Please Enter speciality.";
		}
		else if(empty($price)){
			$errMSG = "Please Enter price.";
		}
		else if(empty($availability)){
			$errMSG = "Please Enter availability.";
		}

		else if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'img/users/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$imgpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$imgpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO offers(email,product,speciality,price,availability,img,created) VALUES(:uemail, :uproduct,:uspeciality, :uprice, :uavailability, :uimg, now())');
			$stmt->bindParam(':uemail',$email);
			$stmt->bindParam(':uproduct',$product);
			$stmt->bindParam(':uspeciality',$speciality);
			$stmt->bindParam(':uprice',$price);
			$stmt->bindParam(':uavailability',$availability);
			$stmt->bindParam(':uimg',$imgpic);
			
			if($stmt->execute())
			{ 
				$successMSG = "New Offer succesfully inserted ...";
				
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

    	<h1 class="h2">Add New Offers <a class="btn btn-default" href="venoffers.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	<tr>
    	<td><label class="control-label">Vendor Account.</label></td>
        <td><input class="form-control" type="text" name="email" value="<?php echo $row['email']; ?>"  readonly/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Product name.</label></td>
        <td><input class="form-control" type="text" name="product" placeholder="Enter Product name" value="<?php echo $product; ?>" /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Product speciality.</label></td>
        <td><select  name="speciality" id="speciality" class="form-control input-md">
                <option>Heart</option>
                <option>Chest</option>
            </select>
        </td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Price per one.</label></td>
        <td><input class="form-control" type="number" name="price" placeholder="Enter Price per one" value="<?php echo $price; ?>" /></td>
    </tr>
        <tr>
    	<td><label class="control-label">Stock Availability.</label></td>
        <td><input class="form-control" type="number" name="availability" placeholder="Enter Stock availability" value="<?php echo $availability; ?>" /></td>
    </tr>

    
    <tr>
    	<td><label class="control-label">Profile Img.</label></td>
        <td><input class="input-group" type="file" name="img" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Add Offer
        </button>
        </td>
    </tr>
    
    </table>
<input class="form-control" type="text" name="account" value="<?php echo $row['email']; ?>" style="visibility:hidden" readonly/>
<input class="form-control" type="text" name="action" value="Add New Offer" style="visibility:hidden" readonly/>   
</form>

                    </div>
                    </div>

                </section>
   


<?php
include("footer.php");
?>




