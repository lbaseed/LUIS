// JavaScript Document




function full_receipt(trans_id, cid){
	//var trans_id = $("#record_id").text();
	if (cid>0){
		
		$('#fullModal').modal({
			backdrop: 'static'
		});
						$("#modal_full_trans_ref").html(trans_id);

						getTransactionReceipt("modal_full");
	}
	else{
		$('#smallModal').modal({
			backdrop: 'static'
		});

						$("#modal_trans_ref").html(trans_id);

						getTransaction();
	}
	
}

function getTransaction(){
	
	 var itemSelected = $("#modal_trans_ref").html();
var nf = Intl.NumberFormat();
	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_transaction.php?tid='+ itemSelected  +'');
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			
			$('#modal_items_list > tbody').empty();
			
				for (var i=0; i < ourData.length -1; i++){
					
			var records = "<tr><td>"+ ourData[i].qty +"</td><td>"+ ourData[i].ref +"</td><td>"+ ourData[i].sub_total +"</td> </tr>";
				
				$('#modal_items_list tbody').append(records);
					
				}
			
			var index = ourData.length-1;
			var tsales = ourData[index].total_sales;
			var aTendered = ourData[index].amount_tendered;
			var change = ourData[index].change;
			var salesDate = ourData[index].date;
			var timeStamp = ourData[index].timeStamp;
			
			$("#modal_total_label").html(nf.format(tsales));
			$("#modal_amount_tendered").html(nf.format(aTendered));
			$("#modal_change").html(nf.format(change));
			$("#modal_trans_date").html(salesDate);
			$("#modal_footer").append(timeStamp);
			
		};
		ourRequest.send();

		//get data using ajax

		// $.ajax({
		// 	type: 'GET',
		// 	url: "api/get_transaction.php",
		// 	data: {tid: itemSelected},
		// 	success: function(message){
		// 		//open modal box and pass transaction ID

		// 		console.log(message);

		// 		//getTransaction();

		// 	},
		// 	error: function(){
		// 		alert("error");
		// 	}

		// });

}

function getTransactionReceipt(refID){
	
	 var itemSelected = $("#"+ refID +"_trans_ref").html();
	var nf = Intl.NumberFormat();
	
	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_transaction.php?tid='+ itemSelected + '');
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			
			$('#'+ refID +'_items_list > tbody').empty();
			
				for (var i=0; i < ourData.length -2; i++){
					
					
			var records = "<tr><td>"+ ourData[i].qty +"</td><td>"+ ourData[i].ref +"</td><td>"+ nf.format(ourData[i].sold_price) +"</td><td>"+ nf.format(ourData[i].sub_total) +"</td> </tr>";
				
				$('#'+ refID +'_items_list tbody').append(records);
					
				}
			
			var index = ourData.length-2;
			var tsales = parseFloat(ourData[index].total_sales);
			var aTendered = parseFloat(ourData[index].amount_tendered);
			var change = ourData[index].change;
			var salesDate = ourData[index].date;
			var timeStamp = ourData[index].timeStamp;
			var mop = ourData[index].mop;
			var mop_text = "";
			
			if (aTendered===0) {$("#receipt_type").html("Credit Receipt");} else if (aTendered>0 && aTendered < tsales) {$("#receipt_type").html("Deposite Receipt");} else {$("#receipt_type").html("Full Payment Receipt");}
				
			$("#"+ refID +"_total_label").html(nf.format(tsales));
			$("#"+ refID +"_amount_tendered").html(nf.format(aTendered));
			
			
			$("#"+ refID +"_change").html(nf.format(change));
			if (change > 0 ) { $("#"+ refID +"_change_text").html("Change: "); } else { $("#"+ refID +"_change_text").html("Balance Payable: "); }
			
			$("#"+ refID +"_trans_date").html("Date: "+salesDate);
			$("#"+ refID +"_footer_timestamp").html("date/time: " + timeStamp);
			
			
			//converting mop to text
			if (mop == "0" ) {mop_text = "Loan";}
			if (mop == "0/1" ) {mop_text = "Cash";}
			if (mop == "0/1/2" ) {mop_text = "Cash/POS";}
			if (mop == "0/1/2/3" ) {mop_text = "Cash/POS/Trnf";}

			if (mop == "0/2" ) {mop_text = "POS";}
			if (mop == "0/2/3" ) {mop_text = "POS/Trnf";}

			if (mop == "0/1/3" ) {mop_text = "Cash/Trnf";}
			if (mop == "0/3" ) {mop_text = "Trnf";}

			
			$("#"+ refID +"_payment_channel").html(mop_text);
			
			var cu_index = ourData.length-1;
			var cu_name = ourData[cu_index].full_name;
			var cu_address = ourData[cu_index].address;
			var cu_phone = ourData[cu_index].phone;
			
			$("#"+ refID +"_cust_name").text(cu_name);
			$("#"+ refID +"_cust_addr").text(cu_address);
			$("#"+ refID +"_cust_phone").text(cu_phone);
		};
		ourRequest.send();
}

function getDepositePaybackTrans(refId){
	
			$('#deposite_payback_Modal').modal({
				backdrop: 'static'
			});

			$("#modal_depo_ref").html(refId);
			var nf = Intl.NumberFormat();
		

	$.ajax({
		type: 'GET',
		url: "api/get_deposite_payback.php",
		data: {id: refId},
		success: function(message){
			var ourData = JSON.parse(message);
			
		   var index = 0;
		   var ind = 1;
		   var aTendered = ourData[index].amount;
		   
		   var paymentDate = ourData[index].date;
		   var type = ourData[index].payment_type;
		   var remainingBal = ourData[1];
		   console.log(remainingBal);
		   

		   $("#modal_payment_type").html(type);
		   $("#modal_amount").html(nf.format(aTendered));
		   $("#modal_balance").html(nf.format(remainingBal));
		   $("#modal_depo_date").html(paymentDate);
		   

		},
		error: function(){
			alert("error");
		}

	});

}

//printing function
function printDiv(div) {    
    // Create and insert new print section
    var elem = document.getElementById(div);
    var domClone = elem.cloneNode(true);
    var $printSection = document.createElement("div");
    $printSection.id = "printSection";
    $printSection.appendChild(domClone);
    document.body.insertBefore($printSection, document.body.firstChild);

    window.print(); 

    // Clean up print section for future use
    var oldElem = document.getElementById("printSection");
    if (oldElem != null) { oldElem.parentNode.removeChild(oldElem); } 
                          //oldElem.remove() not supported by IE

    return true;
}

function printFull(div) {    
    // Create and insert new print section
    var elem = document.getElementById(div);
    var domClone = elem.cloneNode(true);
    var $printSection = document.createElement("div");
    $printSection.id = "printSection";
    $printSection.appendChild(domClone);
    document.body.insertBefore($printSection, document.body.firstChild);

    window.print(); 

    // Clean up print section for future use
    var oldElem = document.getElementById("printSection");
    if (oldElem != null) { oldElem.parentNode.removeChild(oldElem); } 
                          //oldElem.remove() not supported by IE

    return true;
}



//numbers only function
function numericOnly(fieldID){

  $('#'+ fieldID +'').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});
}