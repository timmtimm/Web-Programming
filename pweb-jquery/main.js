$(document).ready(function () {
    $("#addBookButton").click(function () {
        let bookName = $("#addBook").val();
        
        if (bookName == "")
        {
            return;
        }
        else
        {
            $("#bookList").append('<option> '+ bookName +' </option>');
            Swal.fire(
                'Your book added to list',
                '',
                'success'
            )
        }
    });

    $("#shrink").click(function (e) {
        e.preventDefault;
        $("#book-form").animate({ maxWidth: "40rem" }, 1000);
    });

    $("#expand").click(function (e) {
        e.preventDefault;
        $("#book-form").animate({ maxWidth: "65rem" }, 1000);
    });
});  