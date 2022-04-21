
$('.update_app').click(function(){

    uni_modal("Update Appointment","src/components/modals/update_appointment.php?id="+$(this).attr('data-id'),"mid-large")

})

$('#new_appointment').click(function(){
    uni_modal("Add Appointment","src/components/modals/new_appointment.php","mid-large")
})
$('.delete_app').click(function(){
    _conf("Are you sure to delete this appointment?","delete_app",[$(this).attr('data-id')])
})

function delete_app($id){
    start_load()
    $.ajax({
        url:'admin/ajax.php?action=delete_appointment',
        method:'POST',
        data:{id:$id},
        success:function(resp){
            if(resp==1){
                alert_toast("Data successfully deleted",'success')
                setTimeout(function(){
                    location.reload()
                },1500)

            }
        }
    })
}