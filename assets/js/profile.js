function readFile(file) {
    reader = new FileReader();
    reader.onload = function (e) {
        text = e.target.result;
        img = new Image();
        img.onload = function () {
            if (img.width > img.height) {
                ratio = 500 / img.width
            } else {
                ratio = 500 / img.height;
            }
            rw = ratio * img.width;
            rh = ratio * img.height;
            canvas = $('<canvas width="500" height="500" style="display: none;"></canvas>');
            ctx = canvas[0].getContext('2d');
            console.log('rw: ' + rw + ', rh: ' + rh + ', cuc: ')
            console.log(250 - (rw / 2))
            console.log(250 + (rw / 2))
            ctx.drawImage(this, 250 - (rw / 2), 250 - (rh / 2), rw, rh);
            dataurl = canvas[0].toDataURL('image/png');
            $('#prod_preview-img').attr('src', dataurl);
        }
        img.src = text;
    }
    reader.readAsDataURL(file);
}


function initShopSite() {
    $('#prod_holder').sortable({
        placeholder: "ui-state-highlight slide-inner placeholder col-xs-6 col-sm-4 col-md-3"
    });
    $.ajax({
        type: 'POST',
        url: 'Admin_API/getAllCategories',
        encode: true,
        success: function (result) {
            result = JSON.parse(result)
            result.forEach(function (element) {
                $('#cat_select').append($('<option></option>').text(element['name']).attr('value', element['id']))
            }, this)
            $('#cat_holder').data('categories').split(';').forEach( function (element) {
                t = $('#cat_select option[value='+element+']').text()
                a = $(`<li class="list-group-item">
                                <div class="delete-row">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </div>`+ t +`</li>`)
                a.data('id',element).appendTo('#cat_holder')
            }, this)
        },
        error: function (xhr, status, error) {}
    })
    $('#prod_holder').data('deleted', [])
    
    $('#shop_add-button').click(function () {
        $(this).prop('disabled', true)
        products = []
        $('#prod_holder li').each(function() {
            self = $(this);
            prod = {};
            (self.data('old')) ? prod.type = 'old' : prod.type = 'new';
            prod.id = self.data('id');
            (self.hasClass('pinned-product')) ? prod.pinned = true : prod.pinned = false;
            prod.price = self.find('.price h2').text().replace('Ft','');
            (self.data('old')) ? prod.image = '' : prod.image = self.find('img').attr('src');
            (self.data('old')) ? prod.name = '' : prod.name = self.data('name');
            (self.data('old')) ? prod.link = '' : prod.link = self.data('link');
            products.push($.extend(true, {}, prod));
            prod = {}
        })
        console.log({
                shop: {
                    name: $('#shop_name').val(),
                    link: $('#shop_link').val(),
                    phone: $('#shop_phone').val(),
                    facebook: $('#shop_facebook').val(),
                    image: $('#shop_image').val(),
                    bio: $('#shop_bio').val(),
                    labels: $.makeArray($('#label_holder li:not(.active)')).map(x => $(x).text()),
                    pinned: $.makeArray($('#cat_holder li.pinned:not(.active)')).map(x => $(x).data('id')).join(';'),
                    categories: $.makeArray($('#cat_holder li:not(.active)')).map(x => $(x).data('id')).join(';'),
                    products: products,
                    deleted: $('#prod_holder').data('deleted'),
                    partner: $('#shop_partner').is(':checked'),
                    edit: $('#shops').data('edit')
                }
            });
        $.ajax({
            type: 'POST',
            url: 'Admin_API/addShop',
            data: {
                shop: JSON.stringify({
                    name: $('#shop_name').val(),
                    link: $('#shop_link').val(),
                    phone: $('#shop_phone').val(),
                    facebook: $('#shop_facebook').val(),
                    image: $('#shop_image').val(),
                    bio: $('#shop_bio').val(),
                    labels: $.makeArray($('#label_holder li:not(.active)')).map(x => $(x).text()),
                    pinned: $.makeArray($('#cat_holder li.pinned:not(.active)')).map(x => $(x).data('id')).join(';'),
                    categories: $.makeArray($('#cat_holder li:not(.active)')).map(x => $(x).data('id')).join(';'),
                    products: products,
                    deleted: $('#prod_holder').data('deleted'),
                    partner: $('#shop_partner').is(':checked'),
                    edit: $('#shops').data('edit')
                })
            },
            dataType: 'json',
            encode: true,
            success: function (result) {
                console.log(result);
                location.reload()
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                location.reload()
            }
        })
    })
    $('#shop_list-holder').on('click', 'button', function () {
        $('#label_holder li:not(.active)').remove()
        $('#cat_holder li:not(.active)').remove()
        $('#prod_holder').empty()
        s = $(this).closest('li').data('shop')
        $('#shops').data('edit', s['id'])
        $.ajax({
            type: 'POST',
            url: 'Admin_API/getProducts',
            data: {
                id: s['id']
            },
            encode: true,
            success: function (result) {
                result = JSON.parse(result)
                result.forEach(function (element) {
                    e = $(`<li data-old="true" data-pinned="` + element['pinned'] + `" data-id="` + element['id'] + `" class="col-xs-6 col-sm-4 col-md-3"><div class="delete-product">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            <div class="slide-inner"><div class="product"> <img class='image-responsive' src = "assets/images/products/` + element['imageid'] + `.png">
                            <div class="price"><h2>` + element['price'] + `Ft</h2></div></div>
                            </div></li>`);
                    if (element['pinned'] == 1) {
                        e.addClass('pinned-product')
                    }
                    e.appendTo('#prod_holder');
                }, this)
                $.ajax({
                    type: 'POST',
                    url: 'Admin_API/getLabels',
                    data: {
                        id: s['id']
                    },
                    encode: true,
                    success: function (result) {
                        result = JSON.parse(result)
                        result.forEach(function (element) {
                            $(`<li class="list-group-item">`+ element['name'] +`</li>`).append(`<div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>`).appendTo('#label_holder')
                        }, this)
                    },
                    error: function (xhr, status, error) {}
                })
            },
            error: function (xhr, status, error) {}
        })
        $('#shop_name').val(s['name'])
        $('#shop_link').val(s['adress'])
        $('#shop_phone').val(s['phone'])
        $('#shop_facebook').val(s['facebook'])
        $('#shop_image').val(s['image'])
        $('#shop_bio').val(s['bio'])
        pins = s['pinned'].split(';')

    })
    $(document).on('click', '.delete-row', function() {
        $(this).closest('li').remove()
    })
    $(document).on('click', '.delete-product', function() {
        if($(this).closest('li').data('old')){
            id = $(this).closest('li').data('id')
            a = [id]
            if($.isArray($('#prod_holder').data('deleted'))) {
                a = $.merge(a, $('#prod_holder').data('deleted'))
            } else {
                a.push($('#prod_holder').data('deleted'))
            }
            $('#prod_holder').data('deleted', a)
        }
        $(this).closest('li').remove()
    })
    $('#label_add').click(function() {
        $(`<li class="list-group-item">`+ $('#label_name').val() +`</li>`).append(`<div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>`).appendTo('#label_holder')
        $('#label_name').val('')
    })
    $('#cat_add').click(function() {
        t = $('#cat_select option:selected').text()
        a = $(`<li class="list-group-item">
                                <div class="delete-row">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </div>
                                <div class="pin-row">
                                    <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                                </div>`+ t +`</li>`)
                a.data('id',$('#cat_select').val()).appendTo('#cat_holder')
    })
    $('#prod_imginput').on('change', function () {
            files = this.files;
            readFile(files[0]);
        });
    $('#prod_wrapper .add-row').click(function() {
        $('#prod_upload-holder').toggle()
    })
    $('#prod_add').click(function() {
        e = $(`<li data-old="false" class="col-xs-6 col-sm-4 col-md-3"><div class="delete-product">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div><div class="pin-product">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div><div class="slide-inner"><div class="product"> <img class='image-responsive' src = "">
                            <div class="price"><h2>` + $('#prod_price').val() + `Ft</h2></div></div>
                            </div></li>`);
                            e.find('img').attr('src', $('#prod_preview-img').attr('src'))
                            e.data('name', $('#prod_name').val())
                            e.data('link', $('#prod_link').val())
                            e.appendTo('#prod_holder')
        $('#prod_name').val('')
        $('#prod_link').val('')
        $('#prod_price').val('')
        $('#prod_preview-img').attr('src', '#')
    })
}


$(function () {
    initShopSite()
    $('#logout').click(function () {
        window.location = 'Logout'
    })
    $('.search-input').on('keyup', function () {
        input = $(this)
        filter = input.val().toUpperCase()
        $(this).closest('.list-group').find('li:not(:first)').each(function () {
            if ($(this).text().toUpperCase().indexOf(filter) > -1) {
                $(this).show()
            } else {
                $(this).hide()
            }
        })
    })
})