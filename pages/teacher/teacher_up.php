<div class="informations_teacher">
      
        <div class="col-lg-12">
          <div class="profile_main">
            <div class="img-top">
              
                <div class="background">
                    <h4 style="text-align: center;">L'enseignement <span class="typed" style="font-size: 15px;"></span> </h4>
                  </div>
              
            </div>
            <div class="img__teacher">
              <img src="../public/teacher_image/<?=get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_image')?>" alt="">
            </div>
            <div class="text_bas">
              <h3><?=get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_name')?></h3>
              <h5><?=get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_address')?></h5>
              <h5><?=get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_emailid')?></h5>
              <h5>A rejoint l'Université le <?=get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_doj')?></h5>
              <i class='bx bx-edit-alt' id="Index_Student_Custom" data-iduser="<?=$_SESSION['teacher_id']?>"></i>
            </div>
          </div>
        </div>
      
  </div>