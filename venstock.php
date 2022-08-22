
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
<?php
//cansel or edit offer
	require_once 'dbcon.php';
	
	if(isset($_GET['delete_id']))
	{
		$stmt_select = $DB_con->prepare('SELECT img FROM offers WHERE id =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("img/users/".$imgRow['img']);
		
		$stmt_delete = $DB_con->prepare('DELETE FROM offers WHERE id =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
	}

?>


				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Your stock</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="home.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>your stock</span></li>
							</ol>
					
							<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


						
						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title">Dear &nbsp; <b><?php echo $row['fname']; ?>&nbsp;<?php echo $row['lname']; ?> </b>&nbsp;thats your Stock</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools">
									<thead>
										<tr>
											<th style="display:none;">E-mail</th>
											<th>Product</th>
											<th>speciality</th>
											<th>Price</th>
											<th>Stock avail</th>
											<th>Stocked</th>
											<th>action</th>
											<th>Image</th>
											<th>Status</th>

										</tr>
									</thead>

	
									<tbody>
<?php
	
	$stmt = $DB_con->prepare("SELECT * FROM offers where email = '$_COOKIE[user]' && status='Stocked' ORDER BY id DESC");
	$stmt->execute();
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);

?>										
										<tr>
											<td style="display:none;"><?php echo $email; ?></td>
											<td><?php echo $product; ?></td>
											<td><?php echo $speciality; ?></td>
											<td><?php echo $price; ?>&nbsp;$</td>
											<td><?php echo $availability; ?></td>
											<td><?php echo $stocked; ?></td>
							<td>
<?php
if($row['status']=='Pending')
echo"
				<a class='btn btn-info' href='veneditoffer.php?edit_id=$row[id]; ' title='click for edit' onclick='return confirm('Are you sure to make order from this product ?')'>Update Offer</a> 
				</br>
				<a class='btn btn-danger' href='?delete_id=$row[id];' title='click for delete' onclick='return confirm('Are you sure to reject this offer ?')'>Cansel Offer</a>
				";
	else
		echo"<button class='btn btn-default' disabled>No action</button>";?>
			                </td>

			                <td>			    
			                   <img src="img/users/<?php echo $row['img']; ?>" class="img-rounded" width="80px" height="70px" />
                            </td>

                            <td>
                                <?php
                               if($row['status']=='Ordered')
                                echo"<a class='btn btn-success' href='venorder.php?order_id= $row[id]' title='click for confirm order' )'>$status </a>
                                ";
                                else
                                	echo"<button class='btn btn-default' disabled>$status </button>";

                                	?>
                            </td>
										</tr>
<?php
		}
	}
?>
									</tbody>




								</table>
							</div>
						</section>

				</section>




<?php
include("footer.php");
?>







 