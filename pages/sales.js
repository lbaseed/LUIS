// JavaScript Document
$("#fetched_items_list").change(function(){

    var itemSelected = $(this).val();
	
	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_items_list.php?type=one&id='+ itemSelected + '');
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			var price = ourData[0].sale_price;
			var name = ourData[0].name;
			var qty = ourData[0].qty;
			var cost_price = ourData[0].cost_price;

				$("#item_id").val(itemSelected);
				$("#item_name_label").text(name);
				$("#sale_price").val(price);
				$("#qty_left_label").text(" " +qty);
				$("#cost_price").val(cost_price);
				$("#qty").val("");
				$("#qty").focus();
				
		};
		ourRequest.send();
	
});

$("#fetched_customer_list").change(function(){

    var itemSelected = $(this).val();
	
	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_customer_info.php?cid=' + itemSelected + '');
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			var address = ourData[0].address;
			var name = ourData[0].full_name;
			var phone = ourData[0].phone;

				$("#customer_id").val(itemSelected);
				$("#cu_name").val(name);
				$("#cu_address").val(address);
				$("#cu_phone").val(phone);
				
				
		};
		ourRequest.send();
	
});

$("#add").click(function() {
	
	//var e = document.getElementById("fetched_items_list");
	//var item = e.options[e.selectedIndex].value;
	
	
	var item = $("#item_id").val();
	var stockQty = parseFloat($("#qty_left_label").text());
	var name = $("#item_name_label").text();
	var qty = parseFloat($("#qty").val());
	var price = parseFloat($("#sale_price").val());
	var cost_price = parseFloat($("#cost_price").val());
	var serial = $("#item_serial").val();
	
	
	if(name !="") {
		
		if (price >= cost_price) {
			

			if (qty > 0){
				
			
				if (stockQty >= qty){

					
					
						$("#list_items_cart").append('<li class="list-group-item" id="item">' + 
						name + ' <span class="badge bg-cyan" id="item_price">'+ price +'</span> <span class="badge bg-cyan" id="item_qty">'+ qty +'</span> <span class="badge bg-cyan" id="item_id">'+ item +'</span>	<input type="hidden" id="item_serial" value="' + serial + '" /> <a href="javascript:void(0);" id="remove">&times;</a></li> </li>');

					sumCart();

					//clear add panel
					clearAfterAdd();

				}else {alert("Quantity cannot be morethan what is in stock!!!"); }
				//check quantity availability
				
				} else { alert("Quantity cannot be lessthan 1 "); }
				//checking quantity morethan zero
			
			} else { alert("Sale price cannot be lower than cost price"); }
		//end of checking prices
		
	}else {alert("Please select an item with price before addin to cart"); }
});


//remove item from list

$(document).on('click','#remove',function(){
	$(this).parent().remove();
	sumCart();
});

function sumCart(){
	var total = 0;
	
	if ($('#list_items_cart li').size()>0){

		$('#list_items_cart li').each( function() {
		
			var item = $(this);
		   
	
				var ps = item.find("#item_price").html();
				var qt = item.find("#item_qty").html();
	
				var sub_total = parseFloat(ps) * parseFloat(qt);
	
				total += sub_total;
	
				$("#total_sale_label").html(total);
	
		});
	
	} else { $("#total_sale_label").html(0); }
	

}

//generate thermal receipt
$("#thermal_receipt").click(function(){
	
	thermal_receipt();
});

$("#full_receipt").click(function() {
	
	full_receipt();
	
});

$("#deposit_receipt").click(function(){
	
	full_receipt();
	
});
	
	


function thermal_receipt(){

	if ($("#cash_tendered").val() == "") { var cash_tendered = 0; } else { var cash_tendered = parseFloat($("#cash_tendered").val()); }
	
	if ($("#pos_tendered").val() =="") { var pos_tendered = 0; } else { var pos_tendered = parseFloat($("#pos_tendered").val()); }

	if ($("#trnf_tendered").val() == "") { var trnf_tendered = 0; } else { var trnf_tendered = parseFloat($("#trnf_tendered").val()); }

	var amount_tendered = cash_tendered + pos_tendered + trnf_tendered;

	var total_sales = parseFloat($("#total_sale_label").html());

	 var mop = "0";
	if (cash_tendered > 0) {mop = mop + "/1"} else {mop}
	if (pos_tendered > 0) {mop = mop + "/2"} else {mop}
	if (trnf_tendered > 0) {mop = mop + "/3"} else {mop}
	
	var cust_name = $("#cu_name").val();
	var cust_address = $("#cu_address").val();
	var cust_phone = $("#cu_phone").val();
	
	if (cust_name =="" && cust_address == "" && cust_phone == ""){
	
			if ($('#list_items_cart li').size()>0 ) {

				if (amount_tendered >= total_sales)
				{


					var total = 0;
					var data = [];

					//loop through items in cart
					$("#list_items_cart li").each(function(index){

						var item = $(this);

						var item_id = item.find("#item_id").html();
						var price = item.find("#item_price").html();
						var qty = item.find("#item_qty").html();
						var serial = item.find("#item_serial").val();

					//send to sales table ajax

					sub_data={};
					sub_data["item_id"] = item_id;
					sub_data["item_price"] = price;
					sub_data["item_qty"] = qty;
					sub_data["item_serial"] = serial;


					data.push(sub_data);

					});

					//get static items

					 sub2_data={};
						sub2_data["amount_tendered"] = amount_tendered;
						sub2_data["cash_mop"] = cash_tendered;
						sub2_data["pos_mop"] = pos_tendered;
						sub2_data["trnf_mop"] = trnf_tendered;
						sub2_data["mop"] = mop;

						sub2_data["cust_name"] = "";
						sub2_data["cust_address"] = "";
						sub2_data["cust_phone"] = "";

					data.push(sub2_data);

				 //data = JSON.stringify(data);
				$.ajax({
					type: 'POST',
					url: "api/insert_sales.php",
					data: {myData: data},
					success: function(message){
						//open modal box and pass transaction ID

						$('#smallModal').modal({
							backdrop: 'static'
						});
						$("#modal_trans_ref").html(message);

						getTransaction();

					},
					error: function(){
						alert("error");
					}

				});

				}else { alert("Amount Tendered must be equal or morethan Total Sales");}
						//end of amount tendered checking

			}else {alert("Please add items to the cart and select Means of Payment at the Bottom"); }
	
	} else { alert("Plese Empty customer information or use Full Receipt"); }
	//checking customer information must be empty
}

function full_receipt(){
	
	if ($("#cash_tendered").val() == "") { var cash_tendered = 0; } else { var cash_tendered = parseFloat($("#cash_tendered").val()); }
	
	if ($("#pos_tendered").val() =="") { var pos_tendered = 0; } else { var pos_tendered = parseFloat($("#pos_tendered").val()); }

	if ($("#trnf_tendered").val() == "") { var trnf_tendered = 0; } else { var trnf_tendered = parseFloat($("#trnf_tendered").val()); }

	var amount_tendered = cash_tendered + pos_tendered + trnf_tendered;

	var total_sales = parseFloat($("#total_sale_label").html());

	//means of payment
	var mop = "";
	if (cash_tendered > 0) {mop = mop + "/1"} else {mop}
	if (pos_tendered > 0) {mop = mop + "/2"} else {mop}
	if (trnf_tendered > 0) {mop = mop + "/3"} else {mop}


	var cust_id = $("#customer_id").val();
	var cust_name = $("#cu_name").val();
	var cust_address = $("#cu_address").val();
	var cust_phone = $("#cu_phone").val();
	var user_clrs = $("#cur_user_clrs").val();
	
	
	if ($('#list_items_cart li').size()>0) {
		
		//check user clearance to give loans

			if (user_clrs != 3){

					//check customer informtion
					if (cust_name !="" && cust_address !="" && cust_phone !=""){
						
					
					


							var total = 0;
							var data = [];
							//loop through items in cart
							$("#list_items_cart li").each(function(){

								var item= $(this);

								var item_id = item.find("#item_id").html();
								var price = item.find("#item_price").html();
								var qty = item.find("#item_qty").html();
								var serial = item.find("#item_serial").val();

								//send to sales table ajax

								sub_data={};
								sub_data["item_id"] = item_id;
								sub_data["item_price"] = price;
								sub_data["item_qty"] = qty;
								sub_data["item_serial"] = serial;

								data.push(sub_data);

							});

							//get static items

								sub2_data={};
								sub2_data["amount_tendered"] = amount_tendered;
								sub2_data["cash_mop"] = cash_tendered;
								sub2_data["pos_mop"] = pos_tendered;
								sub2_data["trnf_mop"] = trnf_tendered;
								sub2_data["mop"] = mop;
								//customer info
									sub2_data["cust_name"] = cust_name;
									sub2_data["cust_address"] = cust_address;
									sub2_data["cust_phone"] = cust_phone;
									sub2_data["cust_id"] = cust_id;
								data.push(sub2_data);

							//data = JSON.stringify(data);
							$.ajax({
								type: 'POST',
								url: "api/insert_sales.php",
								data: {myData: data},
								success: function(message){
									//open modal box and pass transaction ID

									$('#fullModal').modal({
										backdrop: 'static'
									});
									$("#modal_full_trans_ref").html(message);

									getTransactionReceipt("modal_full");

								},
								error: function(){
									alert("error");
								}

							});

							

					}else{ alert("Fill All customer Information Please"); }

			} else { alert ("You are not allowed to give out loans");}		

		//end of customer information checking
	}else {alert("Please add items to the cart and select Means of Payment at the Bottom"); }
	
	
}

function deposit_receipt(){
	
	var amount_tendered = parseFloat($("#amount_tendered").val());
	var total_sales = parseFloat($("#total_sale_label").html());
	var cust_id = $("#customer_id").val();
	var cust_name = $("#cu_name").val();
	var cust_address = $("#cu_address").val();
	var cust_phone = $("#cu_phone").val();
	var mop = $("#mop").val();
	
	//check items cart
	if ($('#list_items_cart ul li').size()>0 && mop != "" ) {
		
		//check customer informtion
		if (cust_name !="" && cust_address !="" && cust_phone != ""){
			
		
		
		if (amount_tendered < total_sales){
			
		var total = 0;
		var data = [];
		//loop through items in cart
		$("#list_items_cart li").each(function(index){
			
			var item = $("#item_id_"+index).html();
			var price = $("#item_price_"+index).html();
			var qty = $("#item_qty_"+index).html();
			var serial = $("#item_serial_"+index).val();
			var sub_total = parseFloat(price) * parseFloat(qty);
			total += sub_total;
			
			//send to sales table ajax
			
			sub_data={};
			sub_data["item_id"] = item;
			sub_data["item_price"] = price;
			sub_data["item_qty"] = qty;
			sub_data["item_serial"] = serial;
			
			data.push(sub_data);

		});
		
		//get static items
		
			 sub2_data={};
				sub2_data["amount_tendered"] = amount_tendered;
				sub2_data["mop"] = mop;
				sub2_data["cust_name"] = cust_name;
				sub2_data["cust_address"] = cust_address;
				sub2_data["cust_phone"] = cust_phone;
				sub2_data["cust_id"] = cust_id;
			data.push(sub2_data);
		
		 //data = JSON.stringify(data);
		$.ajax({
			type: 'POST',
			url: "api/insert_sales.php",
			data: {myData: data},
			success: function(message){
				//open modal box and pass transaction ID
				
				$('#depModal').modal('show');
				$("#modal_dep_trans_ref").html(message);
				
				if (amount_tendered===0) {$("#receipt_type").html("Credit Receipt");} else {$("#receipt_type").html("Deposite Receipt");}
				
					
				getTransactionReceipt("modal_dep");
				
			},
			error: function(){
				alert("error");
			}
			
		});
			
		} else { alert("Amount Tendered is Morethan or equal Total Sales, Use Full Receipt instead Please");}
			//end of amount tendered checking
			
	  }else{ alert("Fill All customer Information Please"); }
		//end of checking customer information
		
	}else {alert("Please add items to the cart and select Means of Payment at the Bottom"); }

}	
	

function getTransaction(){
	
	 var itemSelected = $("#modal_trans_ref").html();

	 var nf = Intl.NumberFormat();

	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_transaction.php?tid='+ itemSelected  +'');
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			
			$('#modal_items_list > tbody').empty();
			$("#modal_footer")
			
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
			$("#modal_footer_date").html(timeStamp);
			
		};
		ourRequest.send();
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
			var mop_text;
			
			if (aTendered===0) {$("#receipt_type").html("Credit Receipt");} else if (aTendered>0 && aTendered < tsales) {$("#receipt_type").html("Deposite Receipt");} else {$("#receipt_type").html("Full Payment Receipt");}
				
			$("#"+ refID +"_total_label").html(nf.format(tsales));
			$("#"+ refID +"_amount_tendered").html(nf.format(aTendered));
			
			
			$("#"+ refID +"_change").html(nf.format(change));
			
			(change > 0 ? $("#"+ refID +"_change_text").html("Change: ") : $("#"+ refID +"_change_text").html("Balance Payable: ") )
			
			$("#"+ refID +"_trans_date").html("Date: "+salesDate);
			$("#"+ refID +"_footer").html("date/time : " + timeStamp);
			
			//converting mop to text
			if (mop == "0" ) {mop_text = "Loan";}
			if (mop == "0/1" ) {mop_text = "Cash";}
			if (mop == "0/1/2" ) {mop_text = "Cash/POS";}
			if (mop == "0/1/2/3" ) {mop_text = "Cash/POS/Trnf";}

			if (mop == "0/2" ) {mop_text = "POS";}
			if (mop == "0/2/3" ) {mop_text = "POS/Trnf";}

			if (mop == "01/3" ) {mop_text = "Cash/Trnf";}
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





//thermal receipt modal closing and empty fields
$("#modal_close").click(function(){
	clearScreen();
});
$("#smallModal").on('hidden.bs.modal', function(e){
	
	clearScreen();
});

//full receipt modal closing and empty fields
$("#modal_full_close").click(function(){
	
	clearScreen();
});
$("#fullModal").on('hidden.bs.modal', function(e){
	
	clearScreen();
});

//deposite receipt modal closing and empty fields
$("#modal_dep_close").click(function(){
	
	clearScreen();
});
$("#depModal").on('hidden.bs.modal', function(e){
	
	clearScreen();
});

$("#clear_cart").click(function(){
	
	clearScreen();
	
});

//clear screen
function clearScreen(){
	$("#list_items_cart").empty();
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#cu_name").val("");
	$("#cu_address").val("");
	$("#cu_phone").val("");
	$("#cash_tendered").val("");
	$("#pos_tendered").val("");
	$("#trnf_tendered").val("");
	$("#fetched_customer_list").val("first").change();
}

//clear adding param
function clearAfterAdd(){
	
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#qty_left_label").text("");
	$("#item_serial").val("");
	$("#item_name_label").text("");
	$("#fetched_items_list").val("first").change();

	$("#cash_tendered").focus();
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

//sum total tendered
$("#cash_tendered").keyup(function() {

	autoSumSlpitPayment();
});

$("#pos_tendered").keyup(function() {

	autoSumSlpitPayment();
});
$("#trnf_tendered").keyup(function() {

	autoSumSlpitPayment();
});


function autoSumSlpitPayment(){

	var nf = Intl.NumberFormat();

	if ($("#cash_tendered").val() == "") { var cash_td = 0; } else { var cash_td = parseFloat($("#cash_tendered").val()); }
	
	if ($("#pos_tendered").val() =="") { var pos_td = 0; } else { var pos_td = parseFloat($("#pos_tendered").val()); }

	if ($("#trnf_tendered").val() == "") { var trnf_td = 0; } else { var trnf_td = parseFloat($("#trnf_tendered").val()); }
	
	

	var total = cash_td + pos_td + trnf_td;

	
	$("#total_tendered_label").html(nf.format(total));
}

