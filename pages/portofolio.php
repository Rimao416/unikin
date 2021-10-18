
                <div class="student__information">
                <h6 style="display: inline-block;">Mes Informations</h6>
                <hr>
                <div class="student__profile__information">
                    <div class="left__information">
                       <h6><strong>Nom</strong></h6>
                    </div>
                    <div class="right__information">
                        <?=ucfirst($fetch1['student_name'])?>
                    </div>
                    <hr>

                    <div class="left__information">
                    <h6><strong>Numero</strong></h6>
                    </div>
                    <div class="right__information">
                        <?=get_roll_number($connect,$_SESSION['student_id'])?>
                    </div>
                    <hr>
                    <div class="left__information">
                       <h6><strong>Mail</strong></h6> 
                    </div>
                    <div class="right__information">
                            <?=get_student_addresse($connect,$_SESSION['student_id'])?>  
                    </div>
                    <hr>
                    <div class="left__information">
                        <strong>Adr</strong> 
                    </div>
                    <div class="right__information">
                        <?=Get_Student_Con_Adresse($connect,$_SESSION['student_id'])?>
                    </div>
                    <hr>
                </div>
            </div>
