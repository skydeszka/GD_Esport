$(document).ready(() => {
    $("#register-form").submit((e) => {

        let errorCount = 0;

        const nameTag = $("#register-teamname");
        const nameText = nameTag.val();
        
        if(nameText.length < 3){
            ++errorCount;
            ShowError(nameTag.parent(), "A csapatnévnek legalább 3 karakternek kell lennie");
        }

        if(nameText.length > 20){
            ++errorCount;
            ShowError(nameTag.parent(), "A csapatnévnek maximum 20 karakternek kell lennie");
        }

        if(CheckTeamNameExist(nameText, nameTag)){
            ++errorCount;
        }


        if(errorCount == 0)
            return;

        e.preventDefault();
    });
});

function CheckTeamNameExist(name, tag){
    let error  = false;

    const URL = `/api/teams/exist/name.php`;

    $.getJSON({
        url: URL,
        async: false,
        data: {
            name: name
        },
        success: (data) => {
            if(data.code != 200){
                ShowError(tag.parent(), "Váratlan szerverhiba történt!");
                error = true;
            }
    
            if(data.exists == true){
                ShowError(tag.parent(), "Ez a csapatnév már létezik!")
                error = true;
            }
        }
    });

    return error;
}

function ShowError(parentTag, message){
    const error = $(`
    <div class="alert alert-danger data-error mx-auto mt-4" role="alert">
        <div class="fs-3">Hiba!</div>
        <div class="error-message">
            ${message}
        </div>
    </div>
    `);

    parentTag.append(error);

    error.delay(10000).animate({
        height: "0",
        padding: "0",
        margin: "0",
    }, 1000, () => {
        error.remove();
    });
}