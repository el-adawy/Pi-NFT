var user
async function init(){
    try {
        function onIncompletePaymentFound(payment) {
            jQuery.ajax({
                type: "POST",
                url: '',    //backend url for complete incomplete payment
                dataType: 'json',
                data: {pid:payment["identifier"],txid:payment["transaction"]["txid"]}
        });                     
            };
        await Pi.authenticate(scopes, onIncompletePaymentFound).then(function(auth){
            user = auth.user.username; //user = username
            jQuery.ajax({
            type: "POST",
            url: '',      //backend url for access token to verify user
            dataType: 'json',
            data: {user:auth.accessToken},
            success: function(data){
               //function for success
            }
        });
        }) 
    } catch (err) {
        alert(err); //display error if it has
    }
}


async function payment(set_amount) {
    try {
        var a = parseFloat(parseFloat(set_amount).toFixed(7)) //set the amount with 7 decimal
        const payment = Pi.createPayment({                    //create payment function
        amount: a,                                            //set amount
        memo: " test-pi for NFT",                             //set memo if it need(not necessary)
        metadata: { orderId: 1234, itemIds: [11, 42, 314] },  //metadata if it need(not necessary)
        }, 
        {
        onReadyForServerApproval: onPaymentIdReceived,        //callback function when payment need to approve
        onReadyForServerCompletion: onTransactionSubmitted,   //callback function when transaction need to complete
        onCancel: onPaymentCancelled,                         //callback function when payment cancelled
        onError: onPaymentError,                              //callback function when payment error
        });
    }catch(err){
            console.log(err)                                  //catch and display error if it has
    }
}
function onPaymentIdReceived(paymentId){                  //payment approve when user create payment
    jQuery.ajax({
    type: "POST",
    url: '',
    dataType: 'json',
    data: {pid:paymentId}                                 //need at leat payment id for approval
});
    }
function onTransactionSubmitted(pid,txid){                //complete payment when user finish payment
    jQuery.ajax({
    type: "POST",
    url: '',
    dataType: 'json',
    data: {pid:pid,txid:txid}                             // need payment id and transaction id
});   
}
function onPaymentCancelled(){                            //when payment cancell()
}
function onPaymentError(error, payment){                  //when payment error
}
    
