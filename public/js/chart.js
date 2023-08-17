$(function () {
    $.ajax({
        url: `/api/bookchart`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-tokens"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            numBorrowBook(data);
        },
        error: function (error) {
            alert("error");
        },
    });
});

$(function () {
    $.ajax({
        url: `/api/userBorrowChart`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-tokens"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data)
            userBorrowBook(data);
        },
        error: function (error) {
            alert("error");
        },
    });
});
$(function () {
    $.ajax({
        url: `/api/mostusedgenre`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-tokens"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data)
            mostUsedGenre(data);
        },
        error: function (error) {
            alert("error");
        },
    });
});

let bookchart
function numBorrowBook(data) {
    console.log(data);
    const ctx = document.getElementById("myChart");
  bookchart =  new Chart(ctx, {
        type: "bar",
        data: {
            labels: Object.keys(data),
            datasets: [
                {
                    label: "# of Borrowed Books",
                    data: Object.values(data),
                    backgroundColor: "rgba(75, 192, 192, 0.3)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10,
                    },
                },
            },
        },
    });
}

function userBorrowBook(data) {
    const ctx = document.getElementById("myChart1");
    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: Object.keys(data),
            datasets: [
                {
                    label: "Number of User Borrowed Books",
                    data: Object.values(data),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}
function mostUsedGenre(data) {
    const ctx = document.getElementById("myChart2");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: Object.keys(data),
            datasets: [
                {
                    label: "Number of User Borrowed Books",
                    data: Object.values(data),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}
