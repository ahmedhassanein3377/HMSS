
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
$result3 =mysqli_query($con, "SELECT * FROM   offers where $field like '%$value%' && status='Stocked'  ORDER BY id DESC");
	}
?>

	<section role="main" class="content-body">
					<header class="page-header">
						<h2>Vendors billing report for a specific date</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="home.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Vendors billing report for a specific date</span></li>
							</ol>
					
							<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


                        <div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<div class="panel-body">
										<form class="form-horizontal form-bordered" action="report3.php" method="post">
						
											<div class="form-group">
												<input type="text" class="form-control" name="field"  value="stocked" style="visibility:hidden" readonly>
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
								<h2 class="panel-title">Vendors billing report for a specific date</h2>
								
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools">

									<thead>
										<tr>
											<th>E-mail</th>
											<th>Product</th>
											<th>Speciality</th>
											<th>Price</th>
											<th>Total Price</th>
											<th>Created</th>
										</tr>
									</thead>
									     <tbody>
    <?php 
    
        while($res = mysqli_fetch_array($result3)) { 

        echo "<tr class='gradeX'>";
            echo "<td>".$res['email']."</td>";
            echo "<td>".$res['product']."</td>";
            echo "<td>".$res['speciality']."</td>";
            echo "<td>".$res['price']."&nbsp;$</td>";
            echo "<td>".$res['totalp']."&nbsp;$</td>";
            echo "<td>".$res['stocked']."</td>";
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




 