let table;
$(function () {
    table = $("#bookTable").DataTable({
        ajax: {
            url: "/api/books",
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
                data: "title",
            },
            {
                data: null,
                render: function (data) {
                    return `<img class="model-image" src="${data.media[0]?.original_url}" alt="NONE">`;
                },
                class: "data-image",
            },
            {
                data: "genre.genre_name",
            },
            {
                data: "author.name",
            },
            {
                data: "date_released",
            },
            {
                data: null,
                render: function (data) {
                    // console.log(data.name);
                    return `<div class="action-buttons"><button type="button" data-toggle="modal" data-target="#modalCUbook" data-id="${data.id}" class="btn btn-primary edit">
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
        `<button class="btn btn-primary" role="button" aria-disabled="true" id="create" data-toggle="modal" data-target="#modalCUbook">Add Books</button>`
    ).insertBefore("#bookTable_filter");
});

$(document).on("click", "#create", function (e) {
    $("#bookForm").trigger("reset");
    $("#update").hide();
    $("#save").show();

    $.ajax({
        url: `/api/books/create`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-tokens"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("select").empty();

            $("#genre-select").append(
                $("<option>").attr({ value: "" }).html("Select Genre Name")
            );
            $("#author-select").append(
                $("<option>").attr({ value: "" }).html("Select Author Name")
            );

            selectInputs(data.authors, data.genres);
        },
        error: function (error) {
            alert("error");
        },
    });
});

$("#save").on("click", function (e) {
    let formData = new FormData($("#bookForm")[0]);

    $.ajax({
        url: "/api/books",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#modalCUbook").modal("hide");
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

function selectInputs(authors, genres) {
    $.each(authors, function (i, value) {
        $("#author-select").append(
            $("<option>")
                .attr({
                    value: value.id,
                })
                .css({
                    "text-transform": "capitalize",
                })
                .html(`${value.name}`)
        );
    });
    $.each(genres, function (i, value) {
        $("#genre-select").append(
            $("<option>")
                .attr({
                    value: value.id,
                })
                .css({
                    "text-transform": "capitalize",
                })
                .html(value.genre_name)
        );
    });
}

$(document).on("click", ".edit", function () {
    $("#bookForm").trigger("reset");
    let id = $(this).attr("data-id");
    $("#save").hide();
    $("#update").show();
    $("#update").attr({
        "data-id": id,
    });
    $.ajax({
        url: `/api/books/${id}/edit`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-tokens"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $("select").empty();

            $("#title").val(data.books.title);

            $("#author-select").append(
                $("<option>")
                    .attr({
                        value: data.authors.id,
                    })
                    .html(data.books.author.name)
            );

            $("#genre-select").append(
                $("<option>")
                    .attr({
                        value: data.genres.id,
                    })
                    .html(data.books.genre.genre_name)
            );

            $("#date_released").val(data.books.date_released);

            selectInputs(data.authors, data.genres);
        },
        error: function (error) {
            alert("error");
        },
    });
});

$("#update").on("click", function () {
    let id = $(this).attr("data-id");
    let formData = new FormData($("#bookForm")[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ", " + pair[1]);
    }
    formData.append("_method", "PUT");
    $.ajax({
        url: `/api/books/${id}`,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            $("#modalCUbook").modal("hide");
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
            alert(error);
        },
    });
});

$(document).on("click", ".delete", function (e) {
    let id = $(this).attr("data-id");
    alert("Delete?");
    $.ajax({
        url: `/api/books/${id}`,
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
