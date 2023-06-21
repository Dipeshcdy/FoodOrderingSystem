// // const { Toast } = require("bootstrap");
 let Toast;

$(document).ready(function(){
    Toast = Swal.mixin({
        toast:true,
        position:'bottom-end',
        iconColor:'white',
        customClass:{
            popup:'colored-toast'
        },
        showConfirmButton:false,
        timer:1000
    });
});
// $(document).ready(function() {
//     $("#increment").click(function() {
//       var value = parseInt($("#quantity").val());
//       $("#quantity").val(value + 1);
//     });

//     $("#decrement").click(function() {
//       var value = parseInt($("#quantity").val());
//       if (value > 0) {
//         $("#quantity").val(value - 1);
//       }
//     });
//   });

function incrementDecrementBtn(id,btn)
{
    let qty = document.getElementById("qty"+id).value;
    // console.log(id);
    // console.log(btn);
    if(btn === 'minus' && qty>1)
    {
        qty--;
    }
    else if(btn ==='plus')
    {
        qty++;
    }
    document.getElementById("qty"+id).value=qty;

}

function cartItemQtyUpdate(id,btn)
{
    let qty = document.getElementById("qty"+id).value;
    let token = document.getElementById("accessToken").value;
    console.log(id);
    console.log(btn);
    console.log(qty);
    let data={
        btn: btn,
      }
    //   console.log(data);
    //   console.log(token);
    if(btn === 'minus' && qty>1)
    {
        
        if (id && token && qty) {
            $.ajax({
                type: "PUT",
                headers: {"Authorization":`Bearer ${token}`},
                url : "/api/cart-items/quantity/update/"+id,
                data: data,
                success: function (response){
                    console.log(response);
                    
                    document.getElementById("qty"+id).value=response.qty;
                    document.getElementById("price"+id).innerHTML="Rs "+response.qty*response.price;
                    document.getElementById("totalPrice").innerHTML="Rs "+response.totalPrice;
                    
                    // Swal.fire('Success', 'Quantity Updated Successfully', 'success');
                    // console.log(response);
                    // Toast.fire({
                    //     icon:"success",
                    //     title:'<i class="fas fa-shopping-cart me-3">Quantity Updated</i>'
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
    else if(btn ==='plus')
    {
        
        if (id && token && qty) {
            $.ajax({
                type: "PUT",
                headers: {"Authorization":`Bearer ${token}`},
                url : "/api/cart-items/quantity/update/"+id,
                data: data,
                success: function (response){
                    console.log(response);
                    
                    document.getElementById("qty"+id).value=response.qty;
                    document.getElementById("price"+id).innerHTML="Rs "+response.qty*response.price;
                    document.getElementById("totalPrice").innerHTML="Rs "+response.totalPrice;
                    
                    // Swal.fire('Success', 'Quantity Updated Successfully', 'success');
                    // console.log(response);
                    // Toast.fire({
                    //     icon:"success",
                    //     title:'<i class="fas fa-shopping-cart me-3">Quantity Updated</i>'
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


}


function addToCart(id)
{
    console.log(id);
    let token = document.getElementById("accessToken").value;
     let quantity = document.getElementById("qty"+id).value;

     //increment & decrement work in quantity
    // $('#incrementBtn').click(function()
    // {
    //     quantity++;
    // });
    // $('#decrementBtn').click(function()
    // {
    //     quantity--;
    // });





    console.log(quantity);
    let data={
      qty: quantity,
    }
    console.log(token);
    if (id && token && quantity) {
        $.ajax({
            type: "GET",
            headers: {"Authorization":`Bearer ${token}`},
            url : "/api/add-to-cart/"+id,
            data: data,
            success: function (response){
                console.log(response);
                Toast.fire({
                    icon:"success",
                    title:'<i class="fas fa-shopping-cart me-3"></i> Added to Cart'
                });
                document.getElementById("cart_badge").innerHTML = response.item_count;
                console.log(response)
            },
            error : function(error){
                console.log(error);
            }

        });
    }
}