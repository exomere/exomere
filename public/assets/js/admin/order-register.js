
$(function () {
    orderReg.Init();

})

var orderReg = {

    addComma: function (value) {
        value = String(value).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return value;
    },

    removeComma: function (value) {

        for(var i =0 ; i < 5 ; i ++){
            value = value.replace(",", "");
        }
        if (isNaN(parseInt(value))) { // 값이 없어서 NaN값이 나올 경우
            value = "0";
        }
        return parseInt(value);
    },
    

    addProductInfo: function (e) {
        var seq = e.val();
        var name = e.find("option:selected").data("name");
        var price = e.find("option:selected").data("price");
        var pv = e.find("option:selected").data("pv");

        var html = "";

        if($(".product_info_tr").length == 0){
            $(".product_info_body").empty();
        }

        if($(".p_info_"+seq).length == 1){
            var qty = 1*$("#pd_qty_"+seq).val();
            $("#pd_qty_"+seq).val( (qty) + 1);
            $("#pd_total_"+seq).text( orderReg.addComma(price * ((qty) + 1)));
            return false;
        }

        html += "<tr class='product_info_tr p_info_" + seq + "'>";
        html += " <td> <input type='hidden' name='pd_seq[]' value='"+seq+"'>" + name + "</td>";
        html += " <td>" + orderReg.addComma(price) + "</td>";
        html += " <td>" + orderReg.addComma(pv) + "</td>";
        html += " <td><input style='width:80px;' class='form-control qtyProduct' id='pd_qty_"+seq+"' name='pd_qty[]' data-seq='"+seq+"' data-price='"+price+"' type='number' value='1'/></td>";
        html += " <td><span class='pd_total' id='pd_total_"+seq+"'>" + orderReg.addComma(price) + "</span></td>";
        html += " <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='product' data-idx='"+seq+"'>삭제</button></td>";
        html += "</tr>";

        $(".product_info_body").append(html);

        orderReg.totalRecalculating();
    },

    changeQty: function(e){
        var qty = e.val();
        var price = e.data('price');
        var seq = e.data('seq');
        
        $("#pd_total_"+seq).text( orderReg.addComma(qty * price));

        orderReg.totalRecalculating();
    },

    totalRecalculating:function (){
     
        var total = 0;
        var payment_amount = 0;
        var card_payment = 0;
        var account_payment = 0;
        var point_payment = orderReg.removeComma($("#point_payment").val());
        var cash_payment = orderReg.removeComma($("#cash_payment").val());

        $('.pd_total').each(function(index,item){
            total += orderReg.removeComma($(this).text());
        });

        $('.card_payment_price').each(function(index,item){
            card_payment += orderReg.removeComma($(this).val())
        });

        $('.account_payment_price').each(function(index,item){
            account_payment += orderReg.removeComma($(this).val())
        });

        payment_amount = (account_payment + card_payment + point_payment + cash_payment)
        var remain_amount = total - payment_amount;
        
        $("#card_payment").val(orderReg.addComma(card_payment));
        $("#account_payment").val(orderReg.addComma(account_payment));

        $("#total_amount").val(orderReg.addComma(total));
        $("#payment_amount").val(orderReg.addComma(payment_amount));
        $("#remain_amount").val(orderReg.addComma(remain_amount));
    },

    recalculating:function(e){  

        var type = e.data('type');
        var this_value = orderReg.removeComma(e.val());
        var remain_points = orderReg.removeComma($("#remain_points").val());
        console.log(this_value);


        if(type == 'point'){
           if(remain_points < this_value){
                alert('결제포인트보다 잔여포인트가 적습니다.');
                e.val(0);
           }else{
                e.val(orderReg.addComma(this_value));
           }
        }else{
            e.val(orderReg.addComma(this_value));
        }

        

        orderReg.totalRecalculating();
    },
    
    showHideAddress: function (e) {
        var val = e.val();
        if (val == 'scene') {
            $("#receiptDiv").hide();
        } else {
            $("#receiptDiv").show();
        }

    },

    searchMemberInfo: function (e) {
        var text = $("#searchMemberText").val();
        var type = $("#searchMemberType").val();

        if (text == '') {
            alert('검색어를 입력해주세요.');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            dataType: "json",
            url: "/management/member/serarchMember",
            data: {
                "type": type,
                "text": text,
            },
            success: function (res) {
                var html = "";
                if (res.length == 0) {
                    alert('검색결과가 없습니다.');
                } else {
                    $(".memberBody").empty();
                    $.each(res, function (index, data) {
                        html += "<tr>";
                        html += " <td>" + data.seq + "</td>";
                        html += " <td>" + data.name + "</td>";
                        html += " <td>" + data.member_id + "</td>";
                        html += " <td>" + data.member_position + "</td>";
                        html += " <td>" + data.created_at + "</td>";
                        html += " <td><button type='button' class='choisMemberInfo btn btn-primary me-3' data-seq='" + data.seq + "' data-name='" + data.name + "' data-member_id='" + data.member_id + "' data-remain_points='"+data.remain_points+"'>선택</button></td>"
                        html += "</tr>";
                    });
                }
                $(".memberBody").append(html);
            }
        });
    },

    getPostCode: function (){
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
    
                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수
    
                // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;
    
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }
    
                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }
    
                var postArr = new Array();
                postArr.push(data.zonecode);
                postArr.push(fullAddr);
    
                $("#zipcode").val(postArr[0]);
                $("#address").val(postArr[1]);
                $("#address_detail").val('');
                $("#address_detail").focus();
            }
          }).open();
    },

    addCardPaymentInfo: function(){
        
        if($(".cardInfoTr").length == 0){
            $(".cardInfoBody").empty();
        }

        var trCnt = (1*$(".cardInfoTr").length)+1;

        html = "";

        html += "<tr class='cardInfoTr cardInfo_row_"+trCnt+"'>";
        html += "    <td>";
        html += "    <input type='hidden' class='form-control' readonly name='card_company[]' value='"+$("#payment_card_1 option:selected").val()+"'>";
        html += "    <input type='text' class='form-control' readonly name='card_name[]' value='"+$("#payment_card_1 option:selected").text()+"'>";
        html += "    </td>";
        html += "    <td><input type='text' class='form-control' readonly name='card_number[]' value='"+ $("#payment_card_2").val() +"'></td>";
        html += "    <td><input type='text' class='form-control card_payment_price' readonly name='card_payment_price[]' value='"+orderReg.addComma($("#payment_card_10").val())+"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='card_month_plan[]' value='"+$("#payment_card_5").val()+"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='card_year_month[]' value='"+$("#payment_card_6").val()+"/"+$("#payment_card_7").val()+"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='card_approval_number[]' value='"+$("#payment_card_8").val()+"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='card_approval_name[]' value='"+$("#payment_card_3").val()+"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='card_approval_date[]' value='"+$("#payment_card_9").val()+"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='card_password[]' value='"+$("#payment_card_4").val()+"'></td>";
        html += "    <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='card' data-idx='"+trCnt+"' >삭제</button></td>";
        html += "</tr>";
        
        $(".cardInfoBody").append(html);

        orderReg.totalRecalculating();
    },

    addAccountInfoBody: function(){

        if($(".accountInfoTr").length == 0){
            $(".accountInfoBody").empty();
        }

        var trCnt = (1*$(".accountInfoTr").length)+1;
        
        html = "";
        html += "<tr class='accountInfoTr accountInfo_row_"+trCnt+"'>";
        html += "    <td><input type='text' class='form-control' readonly name='account_number[]' value='"+ $("#payment_account_1").val() +"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='account_head[]' value='"+ $("#payment_account_2").val() +"'></td>";
        html += "    <td><input type='text' class='form-control' readonly name='account_date[]' value='"+$("#payment_account_3").val()+"'></td>";
        html += "    <td><input type='text' class='form-control account_payment_price' readonly name='account_payment_price[]' value='"+orderReg.addComma($("#payment_account_4").val())+"'></td>";
        html += "    <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='account' data-idx='"+trCnt+"'>삭제</button></td>";
        html += "</tr>";

        $(".accountInfoBody").append(html);

        orderReg.totalRecalculating();
    },

    infoRowDel: function(e){
        var idx = e.data('idx');
        var type = e.data('type');
        switch (type){
            case "card": 
                $(".cardInfo_row_"+idx).remove();
              break; 
            case "account":
                $(".accountInfo_row_"+idx).remove();
              break;
            case "product":
                $(".p_info_"+idx).remove(); 
              break;
          }

          orderReg.totalRecalculating();
    },

    choisMemberInfo: function(e){
        var id = e.data('member_id');
        var seq = e.data('seq');
        var name = e.data('name');
        var remain_points = e.data('remain_points')
        $(".cancelMemberInfo").trigger('click');

        $("#member_info").val(id+" | "+name);
        $("#member_seq").val(seq);
        $("#remain_points").val(remain_points)
        $("#point_payment").val(0);

        orderReg.totalRecalculating();
    },

    Bind: function () {

        $(document).on("change", "#product_select", function () {
            orderReg.addProductInfo($(this));
        });

        $(document).on("change", "#receipt_method", function () {
            orderReg.showHideAddress($(this));
        });

        $(document).on("click", ".searchMember", function () {
            orderReg.searchMemberInfo($(this));
        });

        $(document).on("input", ".qtyProduct", function () {
            orderReg.changeQty($(this));
        });

        $(document).on("click", ".getPostCode", function () {
            orderReg.getPostCode($(this));
        });

        $(document).on("click", ".addCardPaymentInfo", function () {
            orderReg.addCardPaymentInfo();
        });

        $(document).on("click", ".addAccountInfoBody", function () {
            orderReg.addAccountInfoBody();
        });

        $(document).on("click", ".infoRowDel", function () {
            orderReg.infoRowDel($(this));
        });

        $(document).on("click", ".choisMemberInfo", function () {
            orderReg.choisMemberInfo($(this));
        });

        $(document).on("input", ".totalRecalculating", function () {
            orderReg.recalculating($(this));
        });
        
        
    },

    Init: function () {
        orderReg.Bind();
    }
}


$(function () {
    $('#product_select').select2();
    $('#center_seq').select2();
    $("#payment_card_9").datepicker();
    $("#payment_account_3").datepicker();
    $("#order_date").datepicker();
    $("#order_date").datepicker("option", "dateFormat", 'yy-mm-dd');
    $("#payment_card_9").datepicker("option", "dateFormat", 'yy-mm-dd');
    $("#payment_account_3").datepicker("option", "dateFormat", 'yy-mm-dd');
});  
