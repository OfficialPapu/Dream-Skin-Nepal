$(document).ready(function() {
    $("#Update").click(function(e) {
        e.preventDefault();
        $("#Update").html(`<svg viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>`);
        $('#Update').css("cursor", "not-allowed");
        var formData = new FormData();
        var fileInput = $('input[type="file"]')[0];
        formData.append('file', fileInput.files[0]);
        formData.append('ExcelFile', fileInput.files[0]);
        formData.append('UpdateQuantity', true);
        if (fileInput.files.length === 0) {
            ShowElement("Please select a file to upload.", "rounded-md p-4 bg-red-500/10 text-red-500");
            DisableConfig();
            return;
        }
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Admin/Update Quantity Config.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                DisableConfig();
                if(response['Status']=="Invalid Format"){
                    ShowElement(`${response['Message']}`, "rounded-md p-4 bg-red-500/10 text-red-500");
                    return;
                }
                
                ShowElement("Product quantity updated successfully! The stock is now up to date.", "rounded-md p-4 bg-green-500/10 text-green-800");
                if (response.length > 1) {
                    ShowErrorProducts(response);
                }
            }
        });
    });

    function ShowElement(Html, Class) {
        $("#Output").toggleClass("hidden");
        $("#Output").removeClass();
        $("#Output").html(Html);
        $("#Output").addClass(Class);
    }

    function DisableConfig() {
        $("#Update").html(`Update`);
        $('#Update').css("cursor", "pointer");
    }

    function ShowErrorProducts(response) {
        $('#tbody').html('');
        $('#ErrorDoc').addClass('hidden');
        $('#ErrorTitle').html('Unable to update following products:');
        $('#ErrorTitle').addClass('pb-4 text-red-500');
        $('#ErrorBox').html('Error');

        response.forEach((element, index) => {
            if (index === 0) return;
            $('#tbody').append(`
             <tr>
                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">${element['ProductID']}</td>
                    <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">
                               ${element['Title']}
                            </td>
                 <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">${element['Message']}</td>
                 </tr>
            `);
        });
    }
});