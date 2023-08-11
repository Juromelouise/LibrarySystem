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

function numBorrowBook(data) {
    console.log(data);
    const ctx = document.getElementById("myChart");
    new Chart(ctx, {
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

// function numBorrowBook() {
//     const ctx = document.getElementById("myChart");
//     new Chart(ctx, {
//         type: "bar",
//         data: {
//             labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//             datasets: [
//                 {
//                     label: "# of Votes",
//                     data: [12, 19, 3, 5, 2, 3],
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                 },
//             },
//         },
//     });
// }
