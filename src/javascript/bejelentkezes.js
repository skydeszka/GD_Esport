$(document).ready(()=>{
    $("#show-password").click(function(){
        let text = $(this).text();
    
        if(text == "Mutasd"){
            $(this).text("Elrejt");
            $("#form-password-input").attr("type", "text");
            return;
        }
                
        $(this).text("Mutasd");
        $("#form-password-input").attr("type", "password");
    });
});

{/* <div class="alert alert-danger data-error mx-auto mt-4" role="alert">
        <div class="fs-3">Hiba!</div>
        <div class="error-message">
            Helytelen felhasználónév vagy jelszó!
        </div>
    </div> */}