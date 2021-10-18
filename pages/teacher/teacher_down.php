<div class="teacher_course_profile_himself">
        <div class="teacher_courses_title">
            <h4 style="color: rgb(72,72,72);font-weight:400;font-family:roboto;">Mes Cours</h4>
            <hr >
            <pre></pre>
        </div>
        <?php
            $courses_fetch_recent=$recent_courses->fetchAll();
            $i=0;
            foreach($courses_fetch_recent as $row_recent){  
        ?>
  
        <div class="teacher_courses_pro_himself" data-courses_teacher="<?=$row_recent['section_id']?>">
            <div class="box__teacher">
                <div class="content__first" style="background-color:<?=$color_list[$i]?>;border-left:5px double <?=$color_list2[$i];?>">
                        <h2><?=explode_this($row_recent['section_name'])?></h2>
                    </div>
                    
                    <div class="content__text" data-teacher="<?=$row_recent['section_id']?>">
                        <h4><?=$row_recent['nom_matiere']?></h4>
                        <h5 style="color: #6923D0;"><?=$row_recent['section_name']?></h5></a>
                        <div id="sub__courses" class="sub__courses">
                        </div>
                    </div>
                </div>                
        </div>
        <?php 
            $i+=1;
                    }
        ?>


    </div>

    </div>