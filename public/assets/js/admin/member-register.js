
$(function () {
    memberReg.Init();

})

var memberReg = {

    saveMember : function(e){
        var id = $("#basic-default-member_id").val();
        var check_member_id = $("#check_member_id").val();
        console.log(id +" // "+check_member_id);
        console.log(id == check_member_id);
        if(id != check_member_id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                dataType: "json",
                url: "/management/member/checkMemberID",
                data: {
                    "id": id,
                },
                success: function (res) {
                   if(res.check == 'Y'){
                    alert('해당 아이디가 이미 존재합니다.');
                   }else{
                    $("#memberForm").submit();
                   }
                }
            });
        }else{
            $("#memberForm").submit();
        }
    },

    searchMemberInfo: function (e) {
        
        var mode = e.data('mode');
        var member_nation = e.data('nation');
        
        var text = $("#searchMemberText_"+mode).val();
        var type = $("#searchMemberType_"+mode).val();

        var search_word_message = "검색어를 입력해주세요.";
        var search_null_message = "검색결과가 없습니다.";

        if(member_nation == 'JP'){
            search_word_message = "検索ワードを入力してください.";
            search_null_message = "検索結果がありません.";
        }else if(member_nation == 'USA'){
            search_word_message = "Please enter a search term";
            search_null_message = "No search results found.";
        }
        
        if (text == '') {
            alert(search_word_message);
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            dataType: "json",
            url: "/management/member/searchMember",
            data: {
                "type": type,
                "text": text,
            },
            success: function (res) {
                var html = "";
                if (res.length == 0) {
                    alert(search_null_message);
                } else {
                    $(".memberBody_"+mode).empty();
                    $.each(res, function (index, data) {
                        html += "<tr>";
                        html += " <td>" + data.seq + "</td>";
                        html += " <td>" + data.name + "</td>";
                        html += " <td>" + data.member_id + "</td>";
                        html += " <td>" + data.member_position + "</td>";
                        html += " <td>" + data.created_at + "</td>";
                        html += " <td><button type='button' class='choisMemberInfo btn btn-primary me-3' data-mode='"+mode+"' data-seq='" + data.seq + "' data-name='" + data.name + "' data-member_id='" + data.member_id + "' data-remain_points='"+data.remain_points+"'>선택</button></td>"
                        html += "</tr>";
                    });
                }
                $(".memberBody_"+mode).append(html);
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

    choisMemberInfo: function(e){
        var id = e.data('member_id');
        var seq = e.data('seq');
        var name = e.data('name');
        var mode = e.data('mode');
        $(".cancelMemberInfo").trigger('click');

        $("#recommend_info").val(id+" | "+name);
        $("#recommend_seq").val(seq);
        
        $("#searchMemberText_"+mode).val('');
        $(".memberBody_"+mode).empty();
        var html = "<tr><th colspan='6' style='height:80px; text-align:center;'>회원을 검색해주세요.</th></tr>"
        $(".memberBody_"+mode).html(html);
      
    },
    
    choisEmail: function(e){
        var selectVal = e.val();
        
        if(selectVal == 'custom'){
            $("#email2").val('');
            $("#email2").attr('readonly',false);
        }else{
            $("#email2").val(selectVal);
            $("#email2").attr('readonly',true);
        }
        
    },

    bankChange: function(e){
        if(e.val() == 100){
            $("#etc_banks").css('display','block');
        }else{
            $("#etc_banks").css('display','none');
        }
    },

    Bind: function () {
        $(document).on("click", ".saveMember", function () {
            memberReg.saveMember($(this));
        });

        $(document).on("click", ".searchMember", function () {
            memberReg.searchMemberInfo($(this));
        });

        $(document).on("click", ".getPostCode", function () {
            memberReg.getPostCode($(this));
        });

        $(document).on("click", ".choisMemberInfo", function () {
            memberReg.choisMemberInfo($(this));
        });

        $(document).on("change", "#emailSelect", function () {
            memberReg.choisEmail($(this));
        });

        $(document).on("change", "#basic-default-bank", function () {
            memberReg.bankChange($(this));
        });

    },

    Init: function () {
        memberReg.Bind();
    }
}
$(function () {
    
    $('#basic-default-bank').select2();
    $('#local_store').select2();
    $("#member_reg_date").datepicker();
    $("#member_reg_date").datepicker("option", "dateFormat", 'yy-mm-dd');
    $("#member_reg_date").val($("#created_at").val());
});  