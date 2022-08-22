
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
$field="";
$value="";
if(isset($_POST['submit']))

   {
$field = $_POST['field'];
$value = $_POST['fvalue'];
$result4 =mysqli_query($con, "SELECT * FROM   sell where $field like '%$value%'   ORDER BY id DESC");
	}
?>

	<section role="main" class="content-body">
					<header class="page-header">
						<h2>Customers billing report for a specific date</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="home.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Customers billing report for a specific date</span></li>
							</ol>
					
							<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


                        <div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<div class="panel-body">
										<form class="form-horizontal form-bordered" action="report4.php" method="post">
						
											<div class="form-group">
												<input type="text" class="form-control" name="field"  value="created" style="visibility:hidden" readonly>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" id="from" name="fvalue" class="form-control"  value="<?= $value?>">
													</div>
												</div>
											</div>

                            <div class="col-lg-2">
                            	<input name="submit" type="submit" value="View data" class="btn btn-primary" />
                            </div>
										</form>
									</div>
								</section>
							</div>
						</div>

						 <a onclick="HTMLtoPDF()"><span class="glyphicon glyphicon-save"></span>Export PDF</a>
						<section class="panel" id="HTMLtoPDF">
							<header class="panel-heading">
								<h2 class="panel-title">Customers billing report for a specific date</h2>
								
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools">

									<thead>
										<tr>
											<th>ID-bill</th>
											<th>Customer name</th>
											<th>Product</th>
											<th>Total bill Price</th>
											<th>Created</th>
										</tr>
									</thead>
									     <tbody>
    <?php 
    
        while($res = mysqli_fetch_array($result4)) { 

        echo "<tr class='gradeX'>";
            echo "<td>".$res['id']."</td>";
            echo "<td>".$res['cstname1']."</td>";
            echo "<td>".$res['product1']."</td>";
            echo "<td>".$res['amount']."&nbsp;$</td>";
            echo "<td>".$res['created']."</td>";
        echo "</tr>";
        }?>
        </tbody>



								</table>
							</div>
						</section>

				</section>



<?php
include("footer.php");
?>




 