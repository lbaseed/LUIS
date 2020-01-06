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
				$("#sale_price").val(cost_price);
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
		
		ourRequest.open('GET','api/get_supplier_info.php?cid=' + itemSelected + '');
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
		
			

			if (qty > 0){
				
			
			
						$("#list_items_cart").append('<li class="list-group-item" id="item">' + 
						name + ' <span class="badge bg-cyan" id="item_price">'+ price +'</span> <span class="badge bg-cyan" id="item_qty">'+ qty +'</span> <span class="badge bg-cyan" id="item_id">'+ item +'</span>	<input type="hidden" id="item_serial" value="' + serial + '" /> <a href="javascript:void(0);" id="remove">&times;</a></li> </li>');
						
						sumCart();

					//clear add panel
					clearAfterAdd();

				
				
			} else { alert("Quantity cannot be lessthan 1 "); }
				//checking quantity morethan zero
		
	}else {alert("Please select an item with price before adding to cart"); }
});

//remove item from list

$(document).on('click','#remove',function(){
	$(this).parent().remove();
	sumCart();
});

function sumCart(){
	var total = 0;
	var nf = Intl.NumberFormat();

	if ($('#list_items_cart li').size()>0){

		$('#list_items_cart li').each( function() {
		
			var item = $(this);
		   
	
				var ps = item.find("#item_price").html();
				var qt = item.find("#item_qty").html();
	
				var sub_total = parseFloat(ps) * parseFloat(qt);
	
				total += sub_total;
	
				$("#total_sale_label").html( nf.format(total));
	
		});
	
	} else { $("#total_sale_label").html(0); }
	

}

function checkItemExist_InCart(added_item){

		$('#list_items_cart li').each( function() {
			
			var item = $(this);
		   
	
				var item_id = item.children("#item_id").html();
				
				
				if (added_item == item_id){

					return "added";
				}
				else {
					return "notAdded";
				}
				
		});

	
	
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
	


function full_receipt(){
	

	var supp_id = $("#customer_id").val();
	var supp_name = $("#cu_name").val();
	var supp_address = $("#cu_address").val();
	var supp_phone = $("#cu_phone").val();
	
	
	if ($('#list_items_cart li').size()>0) {
		
		//check customer informtion
		if (supp_name !="" && supp_address !="" && supp_phone != ""){
			
		
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
					 
					 //customer info
						sub2_data["supp_name"] = supp_name;
						sub2_data["supp_id"] = supp_id;
					data.push(sub2_data);

				 //data = JSON.stringify(data);
				$.ajax({
					type: 'POST',
					url: "api/insert_order.php",
					data: {myData: data},
					success: function(message){
						//open modal box and pass transaction ID

						$('#orderModal').modal({ backdrop: 'static' });
						$("#modal_order_ref").html(message);

						getTransactionReceipt("modal_order");

					},
					error: function(){
						alert("error");
					}

				});

				

		}else{ alert("Fill All Supplier Information Please"); }
		//end of customer information checking
	}else {alert("Please add items to the cart"); }
	
	
}

function getReceipt(order_ref){
	$('#orderModal').modal({ backdrop: 'static' });
						$("#modal_order_ref").html(order_ref);

						getTransactionReceipt("modal_order");
}

function getTransactionReceipt(refID){
	
	 var itemSelected = $("#"+ refID +"_ref").html();
	var nf = Intl.NumberFormat();
	
	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_order.php?tid='+ itemSelected + '');
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			
			$('#'+ refID +'_items_list > tbody').empty();
			var sn =1;

				for (var i=0; i < ourData.length -2; i++){
					
					
			var records = "<tr><td>"+ sn +"</td><td>"+ ourData[i].ref +"</td><td>"+ ourData[i].qty +"</td> <td>"+ nf.format(ourData[i].price) +"</td><td>"+ nf.format(ourData[i].value) +"</td> </tr>";
				
				$('#'+ refID +'_items_list tbody').append(records);
				sn++;	
				}
			
			var index = ourData.length-2;
			var tsales = parseFloat(ourData[index].valueOrdered);
			var status = ourData[index].status;
			var dateOrdered = ourData[index].dateOrdered;
			
			$("#receipt_type").html("Placed Order Receipt");

			$("#"+ refID +"_total_label").html(nf.format(tsales));
			$("#"+ refID +"_status").html(status);
			
			$("#"+ refID +"_trans_date").html("Date: " + dateOrdered);
			
			
			
			var cu_index = ourData.length-1;
			var cu_name = ourData[cu_index].full_name;
			var cu_phone = ourData[cu_index].phone;
			
			$("#"+ refID +"_cust_name").html(cu_name);
			$("#"+ refID +"_cust_phone").html(cu_phone);

		};
		ourRequest.send();
}


function processOrder(order_id,sup){


	$.get("api/process_order.php?order="+order_id+"&sup="+sup, function(message){
		
		$("#"+order_id).hide();
		$("#st_"+order_id).html("SUPPLIED");
	});
}


//thermal receipt modal closing and empty fields
$("#modal_close").click(function(){
	clearScreen();
});


//full receipt modal closing and empty fields
$("#modal_order_close").click(function(){
	
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

