function paymentGateway(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = ()=>{
        if(xhttp.readyState == 4 && xhttp.status ==200){

            var obj = JSON.parse(xhttp.responseText);
    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        window.location.href = "../../config/studentconfig/clearcart.php";
        console.log("Payment completed. OrderID:" + orderId);
    // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
    // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "1223133",    // Replace your Merchant ID
        "return_url": "http://localhost/itmansala/src/views/studentviews/cartSudentView.php",     // Important
        "cancel_url": "http://localhost/itmansala/src/views/studentviews/cartSudentView.php",     // Important
        "notify_url": "http://sample.com/notify",
        "order_id": obj["order_id"],
        "items": obj["items"],
        "amount": obj["amount"],
        "currency": obj["currency"],
        "hash": obj["hash"], // *Replace with generated hash retrieved from backend
        "first_name": obj["name"],
        "last_name": obj["name"],
        "email": obj["email"],
        "phone": obj["phone"],
        "address": "No.1, Galle Road",
        "city": "Colombo",
        "country": "Sri Lanka",
        "custom_1": "",
        "custom_2": ""
    };

    payhere.startPayment(payment);
        }
    }
    xhttp.open("GET", "../../config/studentconfig/payhere.php",true);
    xhttp.send();
}