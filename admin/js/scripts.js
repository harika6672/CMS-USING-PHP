 ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
 } );
$(document).ready(function(){
    $('#selectAllCheckbox').click(function(event){
    if(this.checked){
        $('.chk').each(function(){
            this.checked=true;
        })
    }else{
        $('.chk').each(function(){
            this.checked=false;
        })
    }
   
    
})

})


