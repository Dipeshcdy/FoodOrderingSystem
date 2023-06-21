function pendingItemView(id)
{
console.log(id);
var modal = $('#modalBody');
modal.empty();

let token = document.getElementById("accessToken").value;
console.log(token);
if (id && token) {
    $.ajax({
        type: "GET",
        headers: {"Authorization":`Bearer ${token}`},
        url : "/api/admin/order/pending/item/"+id, 
        // data: data,
        success: function (response){
            console.log(response);
            
            $.each(response, function(index, items) {
            var html = `
                <div>
                <h2 class="border-bottom border-secondary border-4 pb-2" style="font-size:20px;">${index} (${items[0].username})</h2>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    `;
            $.each(items,function (index,item) {
                html += `
                        <tr>
                            <td>${item.name}</td>
                            <td>${item.price}</td>
                            <td>${item.qty}</td>
                            <td>${item.qty*item.price}</td>

                        </tr>
                        `;
            });

            html += `
                        </tbody>
                    </table>
                    </div>
                `;
            modal.append(html);
            });

            // Toast.fire({
            //     icon:"success",
            //     title:'<i class="fas fa-shopping-cart me-3"></i> Added to Cart'
            // });
            // document.getElementById("cart_badge").innerHTML = response.item_count;
            // console.log(response)
        },
        error : function(error){
            console.log(error);
        }

    });
}

}


function vendorPendingItemView(id)
{
console.log(id);
var modal = $('#modalBody');
modal.empty();

let token = document.getElementById("accessToken").value;
console.log(token);
if (id && token) {
    $.ajax({
        type: "GET",
        headers: {"Authorization":`Bearer ${token}`},
        url : "/api/vendor/order/pending/item/"+id, 
        // data: data,
        success: function (response){
            console.log(response);
            var html = `
                <div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    `;
            $.each(response, function(index, item) {
                html += `
                        <tr>
                            <td>${item.name}</td>
                            <td>${item.price}</td>
                            <td>${item.qty}</td>
                            <td>${item.qty*item.price}</td>

                        </tr>
                        `;
            });

            html += `
                        </tbody>
                    </table>
                    </div>
                `;
            modal.append(html);

            // Toast.fire({
            //     icon:"success",
            //     title:'<i class="fas fa-shopping-cart me-3"></i> Added to Cart'
            // });
            // document.getElementById("cart_badge").innerHTML = response.item_count;
            // console.log(response)
        },
        error : function(error){
            console.log(error);
        }

    });
}
}

function statusModal(id)
{
    document.getElementById('statusModalId').value=id;
    // $('#statusModalId').=id;
    console.log(id);
}


