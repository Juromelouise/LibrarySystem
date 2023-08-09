let table;
$(function () {
    table = $("#stockTable").DataTable({
        ajax: {
            url: "/api/stocks",
            dataSrc: "",
            contentType: "application/json",
        },
        responsive: true,
        autoWidth: false,
        dom: "Bfrtip",
        columns: [
            
            {
                data: "id",
            },
            {
                data: "book.title",
            },
            {
                data: null,
                render: function (data) {
                    return `<img class="model-image" src="${data.media[0]?.original_url}" alt="NONE">`;
                },
                class: "data-image",
            },
            {
                data: "stock",
            },
            {
                data: null,
                render: function (data) {
                    // console.log(data.name);
                    return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#modalCUstock" data-id="${data.id}" class="btn btn-primary edit">
                <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                        <i class="bi bi-trash3" style="color:white"></i>
                    </button>
                </div>`;
                },
            },
        ],
    });

    $(
        `<button class="btn btn-primary" role="button" aria-disabled="true" id="create" data-toggle="modal" data-target="#modalCUstock">Add Books</button>`
    ).insertBefore("#stockTable_filter");
});

$(document).on("click", "#create", function (e) {
    $('#stockForm').trigger("reset");
    $("#update").hide();
    $("#save").show();

    $.ajax({
        url: `/api/stocks/create`,
        type: 'GET',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-tokens"]').attr('content'),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            
            $('#book-select').show()
            $('#book-label').show()
            // console.log(data);
            $('select').empty();
            $('#book-select').append($('<option>').attr({ "value": "" }).html('Select Books Title'))
            selectInputs(data)
            
        },
        error: function (error) {
            alert("error");
        }

    })
});
function selectInputs(data) {
    $.each(data, function (i, value) {
        $('#book-select').append(
            $('<option>').attr({
                "value": value.id
            }).css({
                "text-transform": "capitalize"
            }).html(`${value.title}`)
        )
    })
}

$("#save").on("click", function (e) {
    let formData = new FormData($("#stockForm")[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    $.ajax({
        url: "/api/stocks",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#modalCUstock").modal("hide");
            table.ajax.reload();
            $(".alert")
                .css({
                    display: "block",
                })
                .html("Successfully Created");
            setTimeout(function () {
                $(".alert").fadeOut(3000, function () {
                    $(this).css({
                        display: "none",
                    });
                });
            }, 2000);
        },
        error: function (error) {},
    });
});

$(document).on('click', '.edit', function () {
    $('#stockForm').trigger("reset");
    let id = $(this).attr('data-id');
    $('#save').hide()
    $('#update').show()
    $('#update').attr({
        "data-id": id
    })
    $.ajax({
        url: `/api/stocks/${id}/edit`,
        type: 'GET',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-tokens"]').attr('content'),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);

            $('#book-select').hide()
            $('#book-label').hide()
            $('#stock').val(data.stock);

        },
        error: function (error) {
            alert("error");
        }

    })
});

$("#update").on('click', function () {
    let id = $(this).attr("data-id");
    let formData = new FormData($('#stockForm')[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    formData.append('_method', 'PUT');
    $.ajax({
        url: `/api/stocks/${id}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            $("#modalCUstock").modal("hide");
            table.ajax.reload();
            $(".alert")
                .css({
                    display: "block",
                })
                .html("Successfully Edited");
            setTimeout(function () {
                $(".alert").fadeOut(3000, function () {
                    $(this).css({
                        display: "none",
                    });
                });
            }, 2000);
        },
        error: function (error) {
            alert(error)
        },
    })
}); 
$(document).on("click", ".delete", function (e) {
    let id = $(this).attr("data-id");
    alert("Delete?");
    $.ajax({
        url: `/api/stocks/${id}`,
        type: "delete",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            table.ajax.reload();
            $(".alert")
                .css({
                    display: "block",
                    position: "absolute",
                })
                .html("Successfully Deleted");
            setTimeout(function () {
                $(".alert").fadeOut(3000, function () {
                    $(this).css({
                        display: "none",
                        
                    });
                });
            }, 2000);
        },
        error: function (error) {
            alert("Dsad");
        },
    });
});