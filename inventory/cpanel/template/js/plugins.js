
/* global end_date */

$(document).ready(function(){
    loadUserActivity(1);
    $(document).on("click",".pagination_link",function(){
        var page=$(this).attr('data-id');
        //alert(page);
        loadUserActivity(page);
    });
    $(document).on('click','.item_link',function(){
        var id_item=$(this).attr('data-id');
        //alert(id_item);
        showSalesDate(id_item);
    });
    //all items
    loadItems(1);
    $(document).on('click','.pagination_item',function(){
        var page=$(this).data('id');
        loadItems(page);
    });
    
    //
    $(".start_date"),$(".end_dates").click(function(){
        var start_date=$(".start_date").val();
        var end_date=$(".end_date").val();
        if(start_date=="" || end_date==""){
           // document.write("<div class='message'><h4>select two dates </h4></div>");
            alert("select two dates that you want to calculate the sales amount between");
        }else{
            specificSalesAmount(start_date,end_date);
            //$(".sales_report").html(start_date+"<br/>"+end_date);
     }
    });

});

function loadUserActivity(page){
    $.ajax({
        url:'pages.php',
        type:'POST',
        data:{
            'retrieve_user':1,
            'page':page
        },
        success:function(data){
            $("#page_content").html(data);
        },
        error:function(error){
            $("#page_content").html(error);
        }
    });
    
}
function showSalesDate(id_item){
    $.ajax({
        url:'pages.php',
        type:'GET',
        data:{
            'show_sales_data':1,
            'id_item':id_item
        },
        success:function(data){
           $("#page_content").html(data);
        },
        error:function(error){
            $("#page_content").html(error);
        }
    });
}
function loadItems(page){
    $.ajax({
        url:'pages.php',
        type:'POST',
        data:{
            'all_items':1,
            'page':page
        },
        success:function(data){
            $("#item_page").html(data);
        },
        error:function(error){
            $("#item_page").html(data);
        }
    });
}

function specificSalesAmount(start_date,end_date){
    $.ajax({
        url:'pages.php',
        type:'POST',
        //async:false,
        data:{
            'showSpecificSales':1,
            'start_date':start_date,
            'end_date':end_date
        },
        success:function(data){
            $(".sales_report").html(data);
        },
        error:function(error){
            $(".sales_report").html(error);
        }
    });
}
