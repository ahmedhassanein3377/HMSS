
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
		<h2>Add To Stock</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="Home.php">
				    <i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Add To Stock</span></li>
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
	
	
	if(isset($_GET['order_id']) && !empty($_GET['order_id']))
	{
		$id = $_GET['order_id'];
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
		$totalp = $_POST['totalp'];
		$Quantity = $_POST['Quantity'];
		$status = $_POST['status'];
			
		
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE offers 
									     SET product=:uproduct, 
									         speciality=:uspeciality,
										     price=:uprice,
										     totalp=:utotalp,
										     availability=:uavailability, 
										     Quantity=:uquantity,
										     status=:ustatus,
										     stocked=now() 
								       WHERE id=:uid');
			$stmt->bindParam(':uproduct',$product);
			$stmt->bindParam(':uspeciality',$speciality);
			$stmt->bindParam(':uprice',$price);
			$stmt->bindParam(':utotalp',$totalp);
			$stmt->bindParam(':uavailability',$availability);
			$stmt->bindParam(':uquantity',$Quantity);
			$stmt->bindParam(':ustatus',$status);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Orders Successfuly Stocked');
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








    	<h1 class="h2">Create order <a class="btn btn-default" href="venoffers.php">See all Offers </a></h1>

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
        <td><input class="form-control" type="text" name="product" value="<?php echo $product; ?>" readonly /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product speciality.</label></td>
        <td><input class="form-control" type="text" name="speciality" value="<?php echo $speciality; ?>" readonly /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Price per one.</label></td>
        <td><input class="form-control" type="text" name="price" value="<?php echo $price; ?>&nbsp;$" readonly /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Stock availability.</label></td>
        <td><input class="form-control" type="text" name="availability" value="<?php echo $availability; ?>" readonly /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Quantity you need.</label></td>
        <td><input class="form-control" type="text" name="Quantity" value="<?php echo $Quantity; ?>" readonly /></td>
    </tr>
  <tr>
    	<td><label class="control-label">Total bill Price.</label></td>
    	<td><input class="form-control" type="text" name="totalp" value="<?php echo $price*$Quantity; ?>" readonly /></td>
    </tr>
    <tr style="visibility:hidden">
    	<td><label class="control-label">Status</label></td>
        <td><input class="form-control" type="text" name="status" value="Stocked" /></td>
    </tr>

    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Add to stock
        </button>
        
        <a class="btn btn-default" href="venoffers.php"> <span class="glyphicon glyphicon-backward"></span> Back </a>
        
        </td>
    </tr>

    
    </table>
<input class="form-control" type="text" name="account" value="<?php echo $row['email']; ?>" style="visibility:hidden" readonly/>
<input class="form-control" type="text" name="action" value="Add Order to stock" style="visibility:hidden" readonly/>     
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














