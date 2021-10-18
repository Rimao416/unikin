
$(function(){
    $('#SectionForm').on('submit',function(event){
    event.preventDefault();
    var SectionEntry=$('#SectionEntry').val()
    if(SectionEntry == ''){
        $('#response').html('<span class="text-danger">Tous les champs se doivent d\'etre rempli</span>');
    }else{
        $.ajax({
        url:'../include/admin/dep_traitement.php',
        method:'POST',
        data:$(this).serialize(),
        beforeSend:function(){
            $('#response').html('<span class="text-info">En attente...</span>')
            $('#response').attr('disabled','disabled')
        },
        success:function(data){
            
            $('#response').html('<span class="text-success ">Reussie</span>')
            $('#response').attr('disabled',false)
            setInterval(() => {
                location.reload()
            },150);
            }
    })
    }
})
 })
