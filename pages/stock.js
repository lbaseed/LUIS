// JavaScript Document



$("#fetched_items_list").change(function(){

    var itemSelected = $(this).val();
	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_items_list.php?type=one&id='+ itemSelected);
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			var price = ourData[0].sale_price;
			var name = ourData[0].name;
			var qty = ourData[0].qty;
			var cost_price = ourData[0].cost_price;

				$("#item_name_label").text(name);
				$("#sale_price").val(price);
				$("#qty_left_label").text(" " +qty);
				$("#cost_price").val(cost_price);
				$("#item_id").val(itemSelected);
				$("#qty").val("");
				$("#qty").focus();
				
		};
		ourRequest.send();
	
});


//generate thermal receipt
$("#thermal_receipt").click(function(){
	
	var amount_tendered = parseFloat($("#amount_tendered").val());
	var total_sales = parseFloat($("#total_sale_label").html());
	var mop = $("#mop").val();
	
	var cust_name = $("#cu_name").val();
	var cust_address = $("#cu_address").val();
	var cust_phone = $("#cu_phone").val();
	
	if (cust_name =="" && cust_address == "" && cust_phone == ""){
	
			if ($('#list_items_cart ul li').size()>0 && mop != "") {

				if (amount_tendered >= total_sales){


				var total = 0;
				var data = [];
				//loop through items in cart
				$("#list_items_cart li").each(function(index){

					var item = $("#item_id_"+index).html();
					var price = $("#item_price_"+index).html();
					var qty = $("#item_qty_"+index).html();
					var sub_total = parseFloat(price) * parseFloat(qty);
					total += sub_total;

					//send to sales table ajax

					sub_data={};
					sub_data["item_id"] = item;
					sub_data["item_price"] = price;
					sub_data["item_qty"] = qty;


					data.push(sub_data);

				});

				//get static items

					 sub2_data={};
						sub2_data["amount_tendered"] = amount_tendered;
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

						$('#smallModal').modal('show');
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
});

$("#full_receipt").click(function() {
	
	var amount_tendered = parseFloat($("#amount_tendered").val());
	var total_sales = parseFloat($("#total_sale_label").html());
	var cust_name = $("#cu_name").val();
	var cust_address = $("#cu_address").val();
	var cust_phone = $("#cu_phone").val();
	
		var mop = $("#mop").val();
	
	if ($('#list_items_cart ul li').size()>0 && mop != "") {
		
		//check customer informtion
		if (cust_name !="" && cust_address !=""){
			
		
				if (amount_tendered >= total_sales){


				var total = 0;
				var data = [];
				//loop through items in cart
				$("#list_items_cart li").each(function(index){

					var item = $("#item_id_"+index).html();
					var price = $("#item_price_"+index).html();
					var qty = $("#item_qty_"+index).html();
					var sub_total = parseFloat(price) * parseFloat(qty);
					total += sub_total;

					//send to sales table ajax

					sub_data={};
					sub_data["item_id"] = item;
					sub_data["item_price"] = price;
					sub_data["item_qty"] = qty;

					data.push(sub_data);

				});

				//get static items

					 sub2_data={};
						sub2_data["amount_tendered"] = amount_tendered;
						sub2_data["mop"] = mop;
						sub2_data["cust_name"] = cust_name;
						sub2_data["cust_address"] = cust_address;
						sub2_data["cust_phone"] = cust_phone;
					data.push(sub2_data);

				 //data = JSON.stringify(data);
				$.ajax({
					type: 'POST',
					url: "api/insert_sales.php",
					data: {myData: data},
					success: function(message){
						//open modal box and pass transaction ID

						$('#fullModal').modal('show');
						$("#modal_full_trans_ref").html(message);

						getTransactionReceipt("modal_full");

					},
					error: function(){
						alert("error");
					}

				});

				} else { alert("Amount Tendered must be equal or morethan Total Sales");}
				//end of amount tendered checking

		}else{ alert("Fill All customer Information Please"); }
		//end of customer information checking
	}else {alert("Please add items to the cart and select Means of Payment at the Bottom"); }
	
});

$("#deposit_receipt").click(function(){
	
	var amount_tendered = parseFloat($("#amount_tendered").val());
	var total_sales = parseFloat($("#total_sale_label").html());
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
			var sub_total = parseFloat(price) * parseFloat(qty);
			total += sub_total;
			
			//send to sales table ajax
			
			sub_data={};
			sub_data["item_id"] = item;
			sub_data["item_price"] = price;
			sub_data["item_qty"] = qty;
			
			data.push(sub_data);

		});
		
		//get static items
		
			 sub2_data={};
				sub2_data["amount_tendered"] = amount_tendered;
				sub2_data["mop"] = mop;
				sub2_data["cust_name"] = cust_name;
				sub2_data["cust_address"] = cust_address;
				sub2_data["cust_phone"] = cust_phone;
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
});


function getTransaction(){
	
	 var itemSelected = $("#modal_trans_ref").html();

	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_transaction.php?tid='+ itemSelected);
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
			
			$("#modal_total_label").html(tsales);
			$("#modal_amount_tendered").html(aTendered);
			$("#modal_change").html(change);
			$("#modal_trans_date").html(salesDate);
			
		};
		ourRequest.send();
}

function getTransactionReceipt(refID){
	
	 var itemSelected = $("#"+ refID +"_trans_ref").html();
	
	
	var ourRequest = new XMLHttpRequest();
		
		ourRequest.open('GET','api/get_transaction.php?tid='+ itemSelected);
		ourRequest.onload = function(){
			var ourData = JSON.parse(ourRequest.responseText);
			
			$('#'+ refID +'_items_list > tbody').empty();
			
				for (var i=0; i < ourData.length -2; i++){
					
			var records = "<tr><td>"+ ourData[i].qty +"</td><td>"+ ourData[i].ref +"</td><td>"+ ourData[i].sold_price +"</td><td>"+ ourData[i].sub_total +"</td> </tr>";
				
				$('#'+ refID +'_items_list tbody').append(records);
					
				}
			
			var index = ourData.length-2;
			var tsales = ourData[index].total_sales;
			var aTendered = ourData[index].amount_tendered;
			var change = ourData[index].change;
			var salesDate = ourData[index].date;
			
			$("#"+ refID +"_total_label").html(tsales);
			$("#"+ refID +"_amount_tendered").html(aTendered);
			$("#"+ refID +"_change").html(change);
			
			$("#"+ refID +"_trans_date").html("Date: "+salesDate);
			
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
	
	$("#list_items_cart ul").empty();
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#cu_name").val("");
	$("#cu_address").val("");
	$("#cu_phone").val("");
	$("#amount_tendered").val("");
	$("#item_name_label").text("");
	$("#qty_left_label").text("");
	$("#total_sale_label").text("");
});
$("#smallModal").on('hidden.bs.modal', function(e){
	
	$("#list_items_cart ul").empty();
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#cu_name").val("");
	$("#cu_address").val("");
	$("#cu_phone").val("");
	$("#amount_tendered").val("");
	$("#item_name_label").text("");
	$("#qty_left_label").text("");
	$("#total_sale_label").text("");
});

//full receipt modal closing and empty fields
$("#modal_full_close").click(function(){
	
	$("#list_items_cart ul").empty();
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#cu_name").val("");
	$("#cu_address").val("");
	$("#cu_phone").val("");
	$("#amount_tendered").val("");
	$("#item_name_label").text("");
	$("#qty_left_label").text("");
	$("#total_sale_label").text("");
});
$("#fullModal").on('hidden.bs.modal', function(e){
	
	$("#list_items_cart ul").empty();
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#cu_name").val("");
	$("#cu_address").val("");
	$("#cu_phone").val("");
	$("#amount_tendered").val("");
	$("#item_name_label").text("");
	$("#qty_left_label").text("");
	$("#total_sale_label").text("");
});

//deposite receipt modal closing and empty fields
$("#modal_dep_close").click(function(){
	
	$("#list_items_cart ul").empty();
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#cu_name").val("");
	$("#cu_address").val("");
	$("#cu_phone").val("");
	$("#amount_tendered").val("");
	$("#item_name_label").text("");
	$("#qty_left_label").text("");
	$("#total_sale_label").text("");
});
$("#depModal").on('hidden.bs.modal', function(e){
	
	$("#list_items_cart ul").empty();
	$("#qty").val("");
	$("#sale_price").val("0");
	$("#cu_name").val("");
	$("#cu_address").val("");
	$("#cu_phone").val("");
	$("#amount_tendered").val("");
	$("#item_name_label").text("");
	$("#qty_left_label").text("");
	$("#total_sale_label").text("");
});


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
function numericOnly(itemId){
$('#'+ itemId +'').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
}