/* @copyright csm developers - web js codes */

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //csm api offers
    $('.api-container').append(
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>' +
        '<div class="swiper-slide swiper-slide-active loader-skl-api"></div>'
    );

    $.ajax({
        url: '/get-api-data',
        type: 'GET',
        dataType: 'json',
        success: function (data) {

            var recordLimit = 15;
           var recordsProcessed = 0;
           var xt = $('#xt').val();
            setTimeout(
                function () {
                    $('.api-container').empty();
                    $.each(data, function (index, item) {
                        recordsProcessed++;
                        if (recordsProcessed >= recordLimit) {
                        return false;
                        }else{
                        let res_game = item.offer_desc.match("game");
                         if (res_game) { var cate = "GAME"; var r_cs = "csm_"; } else { var cate = "APP"; var r_cs = "bg-red"; }
                        var payout = item.amount/xt;
                        $('.api-container').append(
                            '<a href="javascript:void(0)" id="show-api" data-id="' + item.offer_id + '" class="offerList swiper-slide swiper-slide-active" role="group" aria-label="1 / 20">' +
                            '<img src="' + item.image_url + '" alt="' + item.offer_name + '">' +
                            '<div class="mt-2 mb-1">' +
                            '<span class="offer_text font-medium text-slate-700 dark:text-navy-100">' + item.offer_name + '</span>' +
                            '<span class="offer_text text-xs text-slate-400 dark:text-navy-300">' + item.offer_desc + '</span>' +
                            '</div>' +
                            '<div class="flex justify-between gap-1">' +
                            '<div class="off_sp_btn ' + r_cs + '">' + cate + '</div>' +
                            '<div class="font-medium text-slate-700 dark:text-navy-100">' +
                            '$' + payout.toFixed(2) + '</div>' +
                            '</div>' +
                            '</a>'
                        );
                      }
                    });
                }, 1700);

        },

    });

    //csm api offer popup
    $('body').on('click', '#close-csm-api', function () {
        $('#of-api-modal').modal('hide');

        $("#of_api_title").html('');
        $(".api-csm-title").addClass("loader-skl-title");

        $("#of_api_desc").html('');
        $(".csm_of_des").addClass("loader-skl-title");

        $("#csm_of_icon").attr("src", "");
        $(".api-csm-img").addClass("loader-skl-api-img");

        $("#api_stp").html('');
        $("#api_stp").addClass("loader-skl-title");

        $("#cot").html('');
        $("#cot").addClass("loader-skl-title");

        $(".of-csm-con").addClass("loader-skl-api-con");
        $(".ti-1").addClass("csm-h");
        $(".ti-2").addClass("csm-h");
        $(".ti-3").addClass("csm-h");

    });

    $('body').on('click', '#show-api', function () {

        var logchek = $(".log_in_csm").data("id");
        if(logchek){ window.location.replace("/login"); }else{

        var of_id = $(this).data('id');
        $('#of-api-modal').modal('show');

        $.get('/show-api-offers/' + of_id, function (data) {
            $('#of_api_id').html(data.id);
            $(".api-csm-title").removeClass("loader-skl-title");
            $(".api-csm-img").removeClass("loader-skl-api-img");
            $(".csm_of_des").removeClass("loader-skl-title");
            $("#api_stp").removeClass("loader-skl-title");
            $("#cot").removeClass("loader-skl-title");
            $(".of-csm-con").removeClass("loader-skl-api-con");
            $(".ti-1").removeClass("csm-h");
            $(".ti-2").removeClass("csm-h");
            $(".ti-3").removeClass("csm-h");
            $('#of_api_title').html(data.offer_name);
            $('#of_api_desc').html(data.offer_desc);
            $('#api_coin').html(data.amount);
            let res_game = data.offer_desc.match("game");
            if (res_game) {
                $('.off_sp_btn1').html('GAME');
            } else {
                $('.off_sp_btn1').html('APP');
            }
            var ui = $('#ui').val();
            var a_url = data.offer_url.replace('[USER_ID]', ui);
            $('#cot').html(data.disclaimer);
            $('#api_rank').html(data.final_rating);
            $('#api_stp').html(data.call_to_action);
            $(".api_url").attr("href", a_url);
            $('#csm_of_icon').attr('src', data.image_url);
        });

    }

    });

    //csm offers data
    setTimeout(
        function () {
            $(".csm-offers").removeClass("loader-skl");
            $('.offer-backcolor').removeClass("csm-h");
        }, 3000);

    $('body').on('click', '#close-csm', function () {
        document.getElementById("of_if").src = "";
        $('#of-modal').modal('hide');
    });

    $('#of-modal').modal({
        backdrop: 'static',
        keyboard: true,
        show: false
    });

    $('#of-api-modal').modal({
        backdrop: 'static',
        keyboard: true,
        show: false
    });

    $('body').on('click', '#show-offer', function () {
        var logchek = $(".log_in_csm").data("id");
        if(logchek){ window.location.replace("/login"); }
        $("#csm_lo_of").addClass("loader-line");
        var of_id = $(this).data('id');
        var ui = $('#ui').val();
        $.get('/show-offers/' + of_id, function (data) {
            $('#of-modal').modal('show');
            $('#of_id').html(data.id);
            $('#of_title').html(data.title);
            $('#of_if').attr('src', data.slug);
            const usi = document.getElementById('of_if');
            const i_usi = usi.src;
            const new_i_usi = i_usi.replace('USERID',ui);
            usi.src = new_i_usi;
            $('.tab-offer').attr('href', '/offers/'+data.id_name);
            $('#of_if').on("load", function () {
                $("#csm_lo_of").removeClass("loader-line");
            });
        })
    });

    var ck_csm = $('.new_csm_rr').data("id");

    setInterval(function() {
    var elementsWithClass = document.getElementsByClassName('myClass');
    if (elementsWithClass.length > 0) {
    var firstElement = elementsWithClass[0];
    var dataIdValue = firstElement.getAttribute('data-id');
    }
     $.ajax({
        url: '/get-red-data',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
        if (data && !isEmpty(data)) {
            if (ck_csm != 'id-' + data.id) {
                if (dataIdValue != 'id-' + data.id) {
                    var csm_red = document.getElementById('swiper-wrapper-598c411fdede8c28');
                    var nameLimited = data.name.length > 10 ? data.name.substring(0, 6) + '' : data.name; // Limit to 10 characters
                    var new_csm_red =
                        '<div class="card swiper-slide relative flex w-40 flex-col overflow-hidden flex space-x-2 mr-2 csm_an myClass pd" data-id="id-' + data.id + '">' +
                        '<div class="flex bg-red h-9 w-9 shrink-0 items-center justify-center rounded-lg text-white">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>' +
                        '</div>' +
                        '<div>' +
                        '<p class="font-medium text-slate-700 dark:text-navy-100">' + nameLimited + '</p>' + // Use the limited name here
                        '<div class="flex w-full items-center gap-2">' +
                        '<span class="mt-0.5 text-xs text-slate-400 dark:text-navy-300">' + data.request_amount + '</span>' +
                        '<span class="flex w-full items-center gap-1 mt-0.5 text-xs text-slate-400 dark:text-navy-300">' +
                        '<img class="h-3" src="images/app/app-coin.png"><span>' + data.points_used + '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    csm_red.insertAdjacentHTML('afterbegin', new_csm_red);
                }
            }
        }
        },
    });
    }, 5000);
    
    function isEmpty(obj) {
    return Object.keys(obj).length === 0 && obj.constructor === Object;
    }

//ready funcion
});
