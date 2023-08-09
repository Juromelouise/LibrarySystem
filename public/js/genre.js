let table;
$(function () {
    table = $("#genreTable").DataTable({
        ajax: {
            url: "/api/genres",
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
                data: "genre_name",
            },
            {
                data: null,
                render: function (data) {
                    // console.log(data);
                    return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#modalCUgenre" data-id="${data.id}" class="btn btn-primary edit">
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
        `<button class="btn btn-primary" role="button" aria-disabled="true" id="create" data-toggle="modal" data-target="#modalCUgenre">Add Genre</button>`
    ).insertBefore("#genreTable_filter");
});

$(document).on("click", "#create", function (e) {
    $("#genreForm").trigger("reset");
    $("#update").hide();
    $("#save").show();
});

$("#save").on("click", function (e) {
    let formData = new FormData($("#genreForm")[0]);
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ", " + pair[1]);
    // }

    $.ajax({
        url: "/api/genres",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#modalCUgenre").modal("hide");
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

$(document).on("click", ".edit", function (e) {
    let id = $(this).attr("data-id");
    $("#genreForm").trigger("reset");
    $("#update").show();
    $("#update").attr({
        "data-id": id
    });
    $("#save").hide();

    

    $.ajax({
        url: `/api/genres/${id}/edit`,
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $("#genre_name").val(data.genre_name);
        },
        error: function (error) {
            alert("Dsad");
        },
    });
});

$("#update").on('click', function () {
        let id = $(this).attr("data-id");
        let formData = new FormData($('#genreForm')[0]);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        formData.append('_method', 'PUT');
        $.ajax({
            url: `/api/genres/${id}`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                $("#modalCUgenre").modal("hide");
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
            error: function (error) {},
        })
}); 

$(document).on("click", ".delete", function (e) {
    let id = $(this).attr("data-id");
    alert("Delete?");
    $.ajax({
        url: `/api/genres/${id}`,
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

