$(document).ready(function(){

    $("#show-password").click(function(){
        let text = $(this).text();
    
        if(text == "Mutasd"){
            $(this).text("Elrejt");
            $("#password-input").attr("type", "text");
            return;
        }
                
        $(this).text("Mutasd");
        $("#password-input").attr("type", "password");

    });

    $("#register-form").submit(function(form){

        console.log("hi");

        let errorCount = 0;

        const parentId = "register-form";
        const usernameTag = $("#username")
        const username = usernameTag.val();
        const birthDateTag = $("#bday");
        const birthDate = new Date(birthDateTag.val());
        const emailTag = $("#mail");
        const email = emailTag.val();

        if(UsernameHasError(usernameTag, username))
            ++errorCount;
        
        if(EmailHasError(emailTag, email))
            ++errorCount;

        if(new Date().getUTCFullYear() - birthDate.getUTCFullYear() < 16){
            ShowError(birthDateTag.parent(), "Legalább 16 évesnek kell lenned a regisztrációhoz!");
            ++errorCount;
        }

        if(errorCount > 0)
            form.preventDefault();
    })

});

function EmailHasError(tag, email){
    let error = false;

    const URL = `/api/users/exist/email.php?email=${email}`;

    $.getJSON({
        url: URL,
        async: false,
        data: {
            email: email
        },
        success: (data) => {
            if(data.code != 200){
                ShowError(tag.parent(), "Váratlan szerverhiba történt!");
                error = true;
            }
    
            if(data.exists == true){
                ShowError(tag.parent(), "Ez az email már regisztrálva van!")
                error = true;
            }
        }
    });

    return error;
}

function UsernameHasError(tag, username){
    if(username.length < 6){
        ShowError(tag.parent(), "A felhasználónévnek legalább 6 karakter hosszúnak kell lennie!");
        return true;
    }

    if(username.length > 255){
        ShowError(tag.parent(), "A felhasználónév maximum 255 karakter lehet!");
        return true;
    }

    let error  = false;

    const URL = `/api/users/exist/username.php`;

    $.getJSON({
        url: URL,
        async: false,
        data: {
            username: username
        },
        success: (data) => {
            if(data.code != 200){
                ShowError(tag.parent(), "Váratlan szerverhiba történt!");
                error = true;
            }
    
            if(data.exists == true){
                ShowError(tag.parent(), "Ez a felhasználónév már létezik!")
                error = true;
            }
        }
    });

    return error;
}

function ShowError(tagToAppent, message = "Egy hiba történt!") {
    const error = $(`
            <div class="alert alert-danger data-error mx-auto mt-4" role="alert">
                <div class="fs-3">Hiba!</div>
                <div class="error-message">
                    ${message}
                </div>
            </div>
            `);

    tagToAppent.append(error);

    error.delay(10000).animate({
        height: "0",
        padding: "0",
        margin: "0",
    }, 1000, () => {
        error.remove();
    });

    return;
}

function GetFormChild(parentId, name){
    return $(`#${parentId}`).find(`input[name=${name}]`);
}

