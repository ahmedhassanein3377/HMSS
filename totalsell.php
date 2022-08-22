
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
						<h2>Total sell</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Total sell</span></li>
							</ol>
					
							<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


						<a onclick="HTMLtoPDF()"><span class="glyphicon glyphicon-save"></span>Export PDF</a>
						<section class="panel" id="HTMLtoPDF">
							<header class="panel-heading">
								<h2 class="panel-title">Total sell</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools">
									<thead>
										<tr>
											<th>Customer name</th>
											<th>Product</th>
											<th>Amount per $</th>
											<th>Created</th>
										</tr>
									</thead>

	
									<tbody>
<?php
require_once 'dbcon.php';
	
	$stmt = $DB_con->prepare("SELECT * FROM sell  ORDER BY id DESC");
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
?>
										<tr>
											<td><?php echo $cstname1; ?></td>
											<td><?php echo $product1; ?></td>
											<td><?php echo $amount; ?>&nbsp;$</td>
											<td><?php echo $created; ?></td>
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
