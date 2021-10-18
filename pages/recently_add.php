<div class="my_add_courses">
        <?php
            $courses_fetch_recent=$recent_courses->fetchAll();
            $i=0;
            foreach($courses_fetch_recent as $row_recent){  
        ?>
            <div class="unique_card" data-courses_teacher="<?=$row_recent['section_id']?>">
                <div class="card_courses" style="background-color:<?=$color_list[$i]?>;border-left:5px double <?=$color_list2[$i];?>">
                    <h2><?=explode_this($row_recent['section_name'])?></h2>
                </div>
                <br>
                <div class="content__courses">
                    <h4><?=ucfirst($row_recent['nom_matiere'])?></h4>
                    <h5><?=ucfirst($row_recent['section_name'])?></h5>
                    <h6>  Enseigné par <a href="teacher_profile.php?id_teacher=<?=$row_recent['teacher_id']?>"><?=ucfirst($row_recent['teacher_name'])?></a> </h6> 
                    
                </div>
            </div>
        
        <?php 
            $i+=1;
                    }
        ?>
</div>