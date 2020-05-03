
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

var back = (function () {

    var order = 'id';
    var direction = 'desc';

    var pagination = function (event, that, errorAjax) {
        event.preventDefault()
        var href = that.attr('href')
        if (href !== '#') {
            loadpagination(href, errorAjax)
        }
    }

    var loadpagination = function (url, errorAjax) {
        $.get(url)
            .done(function (data) {
                done(data)
            })
            .fail(function () {
                fail(errorAjax)
            }
        )
    }

    var destroy = function (event, that, url, title, confirmButtonText, cancelButtonText, errorAjax) {
        event.preventDefault()
        swal.fire({
            title: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: cancelButtonText,
            confirmButtonText: confirmButtonText
        }).then((result) => {
        if (result.value) {
            ajax(that.attr('href'), 'DELETE', url, errorAjax)
        }
        })
    }

    var ordering = function (url, that, errorAjax) {
        order = that.attr('id')
        direction = that.hasClass('fa-sort') || that.hasClass('fa-sort-desc') ? 'asc' : 'desc'
        // Reset selectors
        $('th span').removeClass().addClass('fa fa-fw fa-sort pull-right')
        // Adjust selected
        that.removeClass().addClass('fa fa-fw fa-sort-' + direction + ' pull-right')
        // Load page
        load(url, errorAjax)
    }

    var filters = function (url, errorAjax) {
        spin()
        load(url, errorAjax)
    }


    var load = function (url, errorAjax) {
        $.get(url, buildParameters())
            .done(function (data) {
                done(data)
            })
            .fail(function () {
                fail(errorAjax)
            }
        )
    }

    var ajax = function (target, verb, url, errorAjax) {
        spin()
        $.ajax({
            url: target,
            type: verb
        })
            .done(function () {
                load(url, errorAjax)
            })
            .fail(function () {
                fail(errorAjax)
            }
        )
    }

    var spin = function () {
        $('#spinner').html('<span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>')
    }

    var unSpin = function () {
        $('#spinner').empty()
    }

    var done = function (data) {
        $('#pannel').html(data.table)
        $('#pagination').html(data.pagination)
        unSpin()
    }

    var fail = function (errorAjax) {
        unSpin()
        swal.fire({
            title: errorAjax,
            icon: 'warning'
        })
    }

    var buildParameters = function () {
        return {
            search: getValueByName('search'),
            order: order,
            direction: direction,
            status:getValueByName('status_search'),
            role: getValueByName('role'),
            company_id: getValueByName('company_id'),
            tourist_place_id: getValueByName('tourist_place_id'),
            museum_id: getValueByName('museum_id'),
            tours_id: getValueByName('tours_id'),
            type: getValueByName('type')
        }
    }

    var getValueByName = function (name) {
        return $('#' + name).val()
    }

    return {
        ajax: ajax,
        destroy: destroy,
        pagination: pagination,
        ordering: ordering,
        filters: filters,
        spin: spin,
        unSpin: unSpin
    }

})()