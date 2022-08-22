
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
//cansel or edit offer
	require_once 'dbcon.php';
	
	if(isset($_GET['delete_id']))
	{	
		$stmt_delete = $DB_con->prepare('DELETE FROM users WHERE id =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
	}

?>

 

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>All Users</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="home.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>All Users</span></li>
							</ol>
					
							<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


						<a onclick="HTMLtoPDF()"><span class="glyphicon glyphicon-save"></span>Export PDF</a>
						<section class="panel" id="HTMLtoPDF">
							<header class="panel-heading">
								<h2 class="panel-title">Control All Users</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools">

									<thead>
										<tr>
											<th>id</th>
											<th>Full Name</th>
											<th>E-mail</th>
											<th>Phone</th>
											<th>Password</th>
											<th>Role</th>
											<th>created</th>
											<th>updated</th>
											<th>Action</th>

										</tr>
									</thead>
<?php
	
	$stmt = $DB_con->prepare("SELECT * FROM users ORDER BY id desc");
	$stmt->execute();
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);

?>	
	
									<tbody>
									
										<tr>
											<td><?php echo $id; ?></td>
											<td><?php echo $fname;?>&nbsp;<?php echo $lname; ?></td>
											<td><?php echo $email; ?></td>
											<td><?php echo $phone; ?></td>
											<td><?php echo $password; ?></td>
											<td><?php echo $role; ?></td>
											<td><?php echo $created; ?></td>
											<td><?php echo $updated; ?></td>
							<td>
		<a class="btn btn-info" href="useredit.php?edit_id=<?php echo $row['id']; ?> " title="click for edit" onclick="return confirm(' Are you sure to make edit ?')" >Update User</a> 
				</br>
				<a class="btn btn-danger" href="?delete_id=<?php echo  $row['id']; ?> " title="click for delete" onclick="return confirm('Are you sure to delete this user ?')" >Delete User</a>
			                </td>
         
										</tr>


									</tbody>
<?php
		}
	}
?>


								</table>
							</div>
						</section>

				</section>



<?php
include("footer.php");
?>




 