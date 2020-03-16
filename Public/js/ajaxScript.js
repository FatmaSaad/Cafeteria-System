function getUpdateProduct(button) {
    var id = button.id;
    currentRow = $(button);

    $.ajax({
        url: "http://localhost/Cafeteria-System/Controller/productEdit.php",
        // url:"productEdit.php",
        method: "GET",
        data: { "id": id },
        datatype: "json",
        success: function (response) {
            // console.log(response);
            var product = JSON.parse(response);
            // console.log(product);
            $("#productId").val(product.product_id);
            $("#productName").val(product.product_name);
            $("#price").val(product.price);
            $("#selected").text(product.category);
            $("#pictureShow").attr('src', `../uploads/${product.image}`);
        }
    });
}
$("#updateProduct").submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        // data: $(this).serialize(),
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        datatype: "json",
        success: function (msg) {
            console.log(msg);
            
            currentRow.parents("tr").find("td:eq(1)").text($("#productName").val());
            currentRow.parents("tr").find("td:eq(2)").text($("#category option:selected").val());
            currentRow.parents("tr").find("td:eq(3)").text($("#price").val());
            // currentRow.parents("tr").find("img)").attr('src',`../uploads/${"#image"}`);
            $('#myModal').modal('toggle');
        },
        error: function () {
            alert("failure");
        }
    });
});