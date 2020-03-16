function getUpdateProduct(button) {
    var id = button.id;
    currentRow = $(button);

    $.ajax({
        url: "http://localhost/Cafeteria-System/Controller/productEdit.php",
        // url:"productEdit.php",
        method: "GET",
        data:{"id":id},
        datatype: "json",
        success: function (response) {
            // console.log(response);
            var product = JSON.parse(response);
            console.log(product);
            $("#productId").val(product.product_id);
            $("#productName").val(product.product_name);
            $("#price").val(product.price);
            $("#selected").text(product.category);
            $("#pictureShow").attr('src',`../uploads/${product.image}`);            

        }
    });
}
$("#updateProduct").submit(function (e) {
    e.preventDefault();  
    console.log( $(this).serialize());
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        datatype:"json",
        success: function (msg) {
            //pass ;
            // var newmsg = JSON.parse(msg);
            console.log(currentRow.parents("tr").find("img"));
            
           console.log($("#productName").val());
            currentRow.parents("tr").find("td:eq(1)").text($("#productName").val());
            currentRow.parents("tr").find("td:eq(3)").text($("#price").val());
            currentRow.parents("tr").find("td:eq(2)").text($("#category").val());
            // currentRow.parents("tr").find("img)").attr('src',`../uploads/${"#image"}`);
            $('#myModal').modal('toggle');
        },
        error: function () {
            //alert("failure");
        }
    });
});