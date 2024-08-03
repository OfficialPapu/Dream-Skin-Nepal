$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Admin/Customer List Config.php",
        data: {
            ListCustomer: true,
        },
        dataType: "json",
        success: function (Data) {
            Data.forEach(element => {
            if(element['User Picture']==''){
                    userImgSrc = "Account/UserAccount/User Images/Default User.png";
                }else{
                    userImgSrc = `Account/UserAccount/User Images/${element['User Picture']}`;
                }
                let newRow = '<tr class="user-data">' +
                    '<td class="user-id">' + element['ID'] + '</td>' +
                    '<td>' +
                    '<div class="user-img-and-name-box">' +
                    '<div class="user-img-and-name">' +
                    '<img src="' + userImgSrc + '" alt="">' +
                    '<div class="number-and-name">' +
                    '<p class="user-name">' + element['First Name'] + ' ' + element['Last Name'] + '</p>' +
                    '<p class="user-number">' + element['Mobile Number'] + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="hide-in-mobile">' + element['Email'] + '</td>' +
                    '<td><a href="Admin/Transaction Record.php?UserID=' + element['ID'] + '"><i class="bx bx-show text-[#00ADEF] text-2xl hover:scale-125 duration-300"></i></a></td>' +
                    '</tr>';

                $('table').append(newRow);
            });
        },
    });
});
