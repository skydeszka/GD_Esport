

$(document).ready(() => {

    const memberList = $("#member-rows");
    if(memberList.length)
        KickMembers(memberList);
});          

function KickMembers(memberList) {
    while (memberList.children().length < 5) {
        memberList.append("<tr><td>Üres hely</td><td></td><td></td><td></td><td></td></tr>");
    }

    $(".kick-member-btn").click((event) => {

        const parent = $(event.target).parent();
        const id = $(event.target).data("id");

        $.post({
            url: "/api/teams/kickmember.php",
            cache: false,
            data: {
                ID: id,
                auth: Cookies.get('user')
            },
            success: function (rawData) {

                console.log(rawData);

                const data = JSON.parse(rawData);

                if (data.success == true) {
                    parent.parent().remove();
                    memberList.append("<tr><td>Üres hely</td><td></td><td></td><td></td><td></td></tr>");
                }
                else {

                    console.log(data);
                }

            },
        });
    });
}
