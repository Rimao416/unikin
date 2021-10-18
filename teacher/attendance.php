<?php
include('header.php');
?>

<div class="container" style="margin-top:30px">
  <div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-md-6"> <h4>Liste des présences <span style="font-size:12px;">Dans le cadre du cours de <?=get_all($connect,'tbl_matiere','id_matiere',$_SESSION['matiere'],'nom_matiere')?></h4> 
        <p id="Nombre" style="opacity:0;"><?=$_SESSION['matiere']?></p>
        <p id="Nombre" style="opacity:0;"><?=$row?></p>
        </div>
        <div class="col-md-6" align="right">
          <button type="button" id="report_button" class="btn btn-danger btn-sm">Génerer un rapport</button>
          <button type="button" id="add_button" class="btn btn-info btn-sm">Faire la présence</button>
        </div>
      </div>
    </div>
   <div class="card-body">


   <div class="table-responsive">
        <span id="message_operation"></span>
     <table class="table table-striped table-bordered" id="attendance_table">
      <thead>
       <tr>
        <th>Nom Etudiant</th>
        <th>Numéro Etudiant</th>
        <th>Classe</th>
              <th>Statut</th>
              <th>Date</th>
       </tr>
      </thead>
      <tbody>
      </tbody>
     </table>
    </div>
   </div>
  </div>
</div>
</body>
</html>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>

<style>
    .datepicker
    {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>

<?php
  $query = "SELECT * FROM tbl_grade WHERE grade_id = (SELECT grade_id FROM tbl_matiere 
    WHERE id_matiere='".$_SESSION["matiere"]."')";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();

?>
<div class="modal" id="formModal">
  <div class="modal-dialog">
    <form method="post" id="attendance_form">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal_title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <?php
          foreach($result as $row)
          {
          ?>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Classe <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <?php 
                echo '<label>'.$row["grade_name"].'</label>';
                ?>
              </div>
            </div>

            <div class="row">
              <label class="col-md-4 text-right">Cours <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <?php 
                echo '<label>'.get_all($connect,'tbl_matiere','id_matiere',$_SESSION['matiere'],'nom_matiere').'</label>';
                ?>
              </div>
            </div>

          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Liste des présences <span class="text-danger">*</span></label>
              
              <div class="col-md-8">
                <input type="text" name="attendance_date" id="attendance_date" readonly class="form-control" />
                <span id="error_attendance_date" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group" id="student_details">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>N°.</th>
                    <th>Etudiant</th>
                    <th>Present</th>
                    <th>Absent</th>
                  </tr>
                </thead>
          <?php
          $sub_query = "
          SELECT * FROM tbl_student 
          WHERE student_grade_id = '".$row["grade_id"]."'
          ";
          $statement = $connect->prepare($sub_query);
          $statement->execute();
          $student_result = $statement->fetchAll();
          foreach($student_result as $student)
          {
          ?>
                <tr>
                  <td><?php echo $student["student_roll_number"]; ?></td>
                  <td>
                    <?php echo $student["student_name"]; ?>
                    <input type="hidden" name="student_id[]" value="<?php echo $student["student_id"]; ?>" />
                  </td>
                  <td align="center">
                    <input type="radio" name="attendance_status<?php echo $student["student_id"]; ?>" value="Present" />
                  </td>
                  <td align="center">
                    <input type="radio" name="attendance_status<?php echo $student["student_id"]; ?>" checked value="Absent" />
                  </td>
                </tr>
          <?php
          }
          ?>
              </table>
            </div>
          </div>
          <?php
          }
          ?>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="attendance_id" id="attendance_id" />
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
        </div>

      </div>
    </form>
  </div>
</div>

<div class="modal" id="reportModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Faire un rapport</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <div class="input-daterange">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Date Début" readonly />
            <span id="error_from_date" class="text-danger"></span>
            <br />
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Date de Fin" readonly />
            <span id="error_to_date" class="text-danger"></span>
          </div>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <input type="hidden" name="student_id" id="student_id" />
        <button type="button" name="create_report" id="create_report" class="btn btn-success btn-sm">J'envoie mon rapport</button>
      </div>

    </div>
  </div>
</div>
<script src="../admin/js/toogle.js"></script>
<script src="../public/js/teacher/attendance_teacher_.js"></script>