$(document).on('click','#Index',function(){
    var attribute=$(this).data('iduser')
    var classeName='ClasseUtilisable'+attribute
    if($('.'+classeName).css('opacity')==0){
        $('.'+classeName).css('opacity',1)
    }else{
        $('.'+classeName).css('opacity',0)
    }
})
$(document).on('click','.modification',function(){
var modification=$(this).data('modifier')
$('.Titre').text("Zone de Modification")
$('#submitSend').text("Modifier")
$('#action').val('Edit')
$('#ElementId').val(modification)
toggle()
})
$(document).on('click','.suppression',function(){
var supprimer=$(this).data('supprimer')
console.log(supprimer)
var action='supprimer'
$.ajax({
    url:'listcours_actions.php',
    method:"POST",
    data:{action:action,supprimer:supprimer},
    success:function(data){
        setInterval(() => {
            location.reload()
        },150);
        }
}) 
})
