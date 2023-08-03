let button = $('.addQuantity')
$(document).on('click', '.addQuantity', function () {

    let id = $(this).attr('data-id');
    let buttonAdd = $(this);

    $.ajax({
        url: `/add/${id}/quantity`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            buttonAdd.siblings('span').html(data.quantity);
            console.log(data);
        },
        error: function (error) {
            alert(error)
        }
    })
})

$(document).on('click', '.minusQuantity', function () {
    console.log("Asdsad");
    let id = $(this).attr('data-id');
    let buttonAdd = $(this);
    $.ajax({
        url: `/reduce/${id}`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            buttonAdd.siblings('span').html(data.quantity);
            console.log(data);
        },
        error: function (error) {
            alert("Sorry antok na developer")
        }
    })
})

$('#borrowSubmit').on('click', function () {
    let returnDate = $('#return_date').val();
    console.log(returnDate);
    $.ajax({
        url: `/checkout`,
        type: "GET",
        data: { "returnDate": returnDate },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#checkoutModal').modal('hide');
            window.location.reload(true)
        },
        error: function (error) {
            alert("Sorry antok na developer")
        }
    })
})
