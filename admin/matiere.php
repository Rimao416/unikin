<?php
    include('../include/admin/header.php');

?>
<div class="container" style="margin-top:30px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">LISTE DES MATIERES</div>
                <div class="col-md-3" align="right">
                    <button type="button" id="add_button" class="btn btn-info btn-sm">Ajouter une classe</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <span id="message_operation"></span>
            <table class="table table-striped table-bordered" id="matiere_table">
                <thead>
                    <tr>
                        <th>Departement</th>
                        <th>Faculte</th>
                        <th>Professeur</th>
                        <th>Grade</th>
                        <th>Matiere</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
<div class="modal" id="formModal">
  <div class="modal-dialog">
    <form method="post" id="matiere_form">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="modal-title"></h5>
          </div>
        <div class="modal-body">
        <div class="input-container">
               
               <input type="text" name="matiere" id="matiere" class="form-control">
             <span id="error_matiere" class="text-danger"></span>
           </div>
            <div class="input-container">
               
                <select name="matiere_name" id="matiere_name" class="form-control">
                            <option value="">Chosir le niveau</option>
                            <?php
                            echo load_grade_list($connect);
                            ?>
              </select>
              <span id="error_matiere_name" class="text-danger"></span>
            </div>
            <div class="input-container">
            <select name="teacher_grade_id" id="teacher_grade_id" class="form-control">
                            <option value="">Chosir le professeur</option>
                            <?php
                            echo load_teacher_list($connect);
                            ?>
            </select>
            <span id="error_teacher" class="text-danger"></span>
            </div>
            <div class="input-container">
            <select name="grade_id" id="grade_id" class="form-control">
                            <option value="">Chosir le departement</option>
                            <?php
                            echo load_dept_list($connect);
                            ?>
            </select>
            <span id="error_id" class="text-danger"></span>
            </div>
        </div>
        <!-- Modal Header -->
        <!-- Modal footer -->
        <div class="modal-footer">
            <input type="hidden" name="matiere_id" id="matiere_id" />
            <input type="hidden" name="action" id="action" value="Add" />
            <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
        </div>

      </div>
    </form>
  </div>
</div>


<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Zone de suppression</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 style="color:#696969;" align="center">Etes vous sûr de vouloir supprimer cet élément</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" name="ok_button" id="ok_button" class="btn btn-primary btn-sm">Oui</button>
      </div>

    </div>
  </div>
</div>


<script src="../public/js/admin/matiere_traiteme.js"></script>