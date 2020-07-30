 function mode_show() {
        var aTags = document.getElementsByTagName("h5");
        var searchText = "New message to undefined";
        var found;

        for (var i = 0; i < aTags.length; i++) {
            if (aTags[i].textContent.includes(searchText)) {
                found = aTags[i];
                aTags[i].textContent = "إدخال بيانات";
            }
        }
    }


    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

   

    window.onload = function () {
        document.getElementById('massage').onkeyup = function () {
            if (this.value.length >= 69) {
                this.style.color = "red";

            }else{
                this.style.color="#000";
            }

            var massages=Math.ceil(this.value.length/69);
            var chars=(chars<69)?this.value.length:this.value.length -(69*massages) ;
            if(chars<0)
                chars=chars*-1;
            document.getElementById('count_msg').innerText = massages+"/"+chars;
        }

    }


    function pop(e) {
        event.preventDefault();
        $(this).addClass("kt-notification__item--read");
        var the_id = e.getAttribute('the_id');
        var the_href = e.getAttribute('the_href');
        console.log(the_href);
        $.get('/admin/getnotfiy/' + the_id, function (data, status) {
        });
        console.log('test');
        location.href = the_href;
    };




    $(function () {
        //$("#Confirm").modal("show");
        $(".Confirm").click(function () {
            $("#kt_modal_1").modal("show");
            $("#kt_modal_1 .btn-danger").attr("href", $(this).attr("href"));
            return false;
        });
    });


    $(document).ready(function () {


$('.table-responsive').on('show.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "inherit" );
});

$('.table-responsive').on('hide.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "auto" );
})

        $('ul.pagination').css({"margin": "auto"});

        function arabicInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/^[\u0621-\u064A\u0660-\u0669\-_@& ]+$/i);
            return pattern.test(value);
        }

        function turkeyInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/[a-zåäöığüşöçĞÜŞÖÇİ\-_@& ]/i);
            return pattern.test(value);
        }

        function numbersInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/^\+?\d*\.?\d*$/i);
            return pattern.test(value);
        }

        $('.arabic').bind('keypress', arabicInput);
        $('.turkey').bind('keypress', turkeyInput);
        $(".numbers").bind('keypress', numbersInput);
        /*keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 1632 || e.which > 1641)) {
                return false;
            }
        });*/
        for(i=0;i<document.querySelectorAll('[data-toggle="dropdown"]').length;i++){
document.querySelectorAll('[data-toggle="dropdown"]')[i].click();
            document.querySelector('#kt_header_menu').click();
$(window).scrollTop(0);
}

var aTags = document.getElementsByTagName("td");
var searchText = "$";
var found;

for (var i = 0; i < aTags.length; i++) {
  if (aTags[i].textContent.includes(searchText)) {
    found = aTags[i];
    aTags[i].style.fontFamily="Aril,serif";
  }
}

var aTags = document.getElementsByTagName("th");
var searchText = "#";
var found;

for (var i = 0; i < aTags.length; i++) {
  if (aTags[i].textContent.includes(searchText)) {
    found = aTags[i];
    aTags[i].style.fontFamily="Aril,serif";
  }
}


    });
    $("form").submit(function(){
        localStorage.removeItem('ids');
    })