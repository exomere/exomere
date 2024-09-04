
$(function () {
    distrReg.Init();

})

var distrReg = {

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
            url: "/management/member/searchMember",
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

    choisMemberInfo: function(e){
        var id = e.data('member_id');
        var seq = e.data('seq');
        var name = e.data('name');
        
        $(".cancelMemberInfo").trigger('click');

        $("#director_info").val(id+" | "+name);
        $("#director_seq").val(seq);

        $("#searchMemberText").val('');
        $(".memberBody").empty();
        var html = "<tr><th colspan='6' style='height:80px; text-align:center;'>회원을 검색해주세요.</th></tr>"
        $(".memberBody").html(html);
      
    },

    Bind: function () {

        $(document).on("click", ".searchMember", function () {
            distrReg.searchMemberInfo($(this));
        });

        $(document).on("click", ".getPostCode", function () {
            distrReg.getPostCode($(this));
        });

        $(document).on("click", ".choisMemberInfo", function () {
            distrReg.choisMemberInfo($(this));
        });
    },

    Init: function () {
        distrReg.Bind();
    }
}
