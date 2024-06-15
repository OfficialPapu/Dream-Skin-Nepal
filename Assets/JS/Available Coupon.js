$(document).ready(function () {
    ListAvaliableCouponcode();
       let CouponValue;
    const listcoupontbody = $('.list-coupon-tbody');
    function ListAvaliableCouponcode() {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Admin/Available Coupon Config.php",
            data: {
                ListAvaliableCouponcode: true
            },
            dataType: "json",
            success: function (Data) {
                if (Data["Message"] != 'Not found') {
                    Data.forEach(element => {
                        const startDate = new Date(element['Start Date']);
                        const formattedStartDate = startDate.toISOString().split('T')[0];
                        const endDate = new Date(element['End Date']);
                        const formattedEndDate = endDate.toISOString().split('T')[0];
                        if(element['Coupon Type']=='Fixed Amount'){
                              CouponValue ="Rs. "+element['Coupon Value']+".00";
                        }else if(element['Coupon Type']=='Percentage'){
                             CouponValue =element['Coupon Value']+"%";
                        }
                        const tableRow = `
                                <tr>
                                    <td>${element['ID']}</td>
                                    <td>${element['Coupon Code']}</td>
                                    <td>${element['Description']}</td>
                                    <td>${formattedStartDate}</td>
                                    <td>${formattedEndDate}</td>
                                    <td>${CouponValue}</td>
                                    <td class="delete-coupon-code" data-coupon-id='${element['ID']}'><i class='bx bxs-x-circle'></i></td>
                                </tr>
                                `;
                        $(listcoupontbody).append(tableRow);
                    });
                } else {
                    $('.coupon-code-list-heading').html("Coupon code is not created");
                }
            }
        });
    }



    $(document).on('click', '.delete-coupon-code', function (e) {
        e.preventDefault();
        let CouponID = $(this).data('coupon-id');
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Admin/Available Coupon Config.php",
            data: {
                DeleteCouponCode: true,
                CouponID: CouponID,
            },
            success: function (response) {
                response = response.trim();
                $(listcoupontbody).empty();
                ListAvaliableCouponcode();
                if (response == 'Success') {
                    butterup.toast({
                        message: 'Coupon Code Deleted Successfully',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else {
                    butterup.toast({
                        message: 'Something went wrong!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            }
        });
    });

});
