let table;
$(function () {
    table = $("#authorsTable").DataTable({
        ajax: {
            url: "/api/authors",
            dataSrc: "",
            contentType: "application/json",
        },
        responsive: true,
        autoWidth: false,
        dom: "Bfrtip",
        // buttons: [
        //     {
        //         text: '<i class="fas fa-plus"></i> Create',
        //         action: create,
        //         className: "buttons-create",
        //     },
        //     {
        //         text: '<i class="fas fa-copy"></i> Copy',
        //         extend: "copyHtml5",
        //     },
        //     {
        //         text: '<i class="far fa-file-excel"></i> Excel',
        //         extend: "excelHtml5",
        //     },
        //     {
        //         text: '<i class="fas fa-file-csv"></i> CSV',
        //         extend: "csvHtml5",
        //     },
        //     {
        //         text: '<i class="fas fa-file-pdf"></i> PDF',
        //         extend: "pdfHtml5",
        //     },
        // ],
        columns: [
            {
                data: "id",
            },
            // {
            //     data: null,
            //     render: function (data) {
            //         return `<img class="model-image" src="${data.img_path}" alt="NONE">`
            //     },
            //     class: "data-image",

            // },
            {
                data: "name",
            },
            {
                data: "gender",
            },
            {
                data: "age",
            },
            {
                data: null,
                render: function (data) {
                    // console.log(data.name);
                    return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#modalCU" data-id="${data.id}" class="btn btn-primary edit">
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
        `<button class="btn btn-primary" role="button" aria-disabled="true" id="create" data-toggle="modal" data-target="#modalCU">Add Author</button>`
    ).insertBefore("#authorsTable_filter");
});

$(document).on("click", "#create", function (e) {
    $("#male").attr({
        checked: false,
    });
    $("#female").attr({
        checked: false,
    });
    $("#authorForm").trigger("reset");
    $("#update").hide();
    $("#save").show();
});

$("#save").on("click", function (e) {
    let formData = new FormData($("#authorForm")[0]);
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ", " + pair[1]);
    // }

    $.ajax({
        url: "/api/authors",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#modalCU").modal("hide");
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
    $("#male").attr({
        checked: false,
    });
    $("#female").attr({
        checked: false,
    });
    $("#authorForm").trigger("reset");
    $("#update").show();
    $("#save").hide();

    let id = $(this).attr("data-id");

    $.ajax({
        url: `/api/authors/${id}/edit`,
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            // console.log(data);
            $("#name").val(data.name);
            $("#age").val(data.age);
            console.log(data.gender);
            if (data.gender == "Female" || data.gender == "female") {
                $("#female").attr({
                    checked: "checked",
                });
            }
            if (data.gender == "Male" || data.gender == "male") {
                $("#male").attr({
                    checked: "checked",
                });
            }
        },
        error: function (error) {
            alert("Dsad");
        },
    });
});

$(document).on("click", ".delete", function (e) {
    let id = $(this).attr("data-id");
    alert("Delete?");
    $.ajax({
        url: `/api/authors/${id}`,
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
