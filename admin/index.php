<?php include('../include/admin/header.php')?>
        <!-- Begin Page Content -->
        <div class="container-fluid px-lg-4">


<div class="row">
<!--
<div class="col-md-12 mt-lg-4 mt-4">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> 
			Generate Report</a>
          </div>
</div>
-->
<!--
                            <div class="col-md-12">
                               <div class="row">
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Sales</h5>
												<h1 class="display-5 mt-1 mb-3">2.382</h1>
												
											</div>
										</div>
										
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Sales</h5>
												<h1 class="display-5 mt-1 mb-3">2.382</h1>
												
											</div>
										</div>
										
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Sales</h5>
												<h1 class="display-5 mt-1 mb-3">2.382</h1>
												
											</div>
										</div>
										
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Earnings</h5>
												<h1 class="display-5 mt-1 mb-3">$21.300</h1>
											</div>
										</div>
										
									</div>
                                </div>
                            </div>
-->

                    <div class="col-md-12 mt-4">
                    <div class="container" style="margin-top:30px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9"><h4 style="color:#ccc;">Statut de fréquentation global des étudiants</h4></div>
                <div class="col-md-3" align="right">

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="student_table">
                    <thead>
                        <tr>
                            <th>Etudiant</th>
                            <th>N°</th>
                            <th>Niveau</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>    


</div>
                   

        </div>

        </div>
        <!-- /.container-fluid -->

      </div>
        </div>
		</div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
  </body>
</html>
<div class="modal" id="formModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Make Report</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="report_action" id="report_action" class="form-control">
                            <option value="pdf_report">PDF Report</option>
                            <option value="chart_report">Chart Report</option>
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <div class="input-daterange">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                            <span id="error_from_date" class="text-danger"></span>
                            <br>
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                            <span id="error_to_date" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="student_id" id="student_id" />
                    <button type="button" name="create_report" id="create_report" class="btn btn-success btn-sm">Create Report</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    
    </div>
<script src="../public/js/admin/index_traitement.js">
</script>
 