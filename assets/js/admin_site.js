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

function readFileBlog(file) {
    reader = new FileReader();
    reader.onload = function (e) {
        text = e.target.result;
        img = new Image();
        img.onload = function () {
            if (img.width/800 > img.height/400) {
                ratio = 800 / img.width
            } else {
                ratio = 400 / img.height;
            }
            rw = ratio * img.width;
            rh = ratio * img.height;
            canvas = $('<canvas width="800" height="400" style="display: none;"></canvas>');
            ctx = canvas[0].getContext('2d');
            ctx.drawImage(this, 400 - (rw / 2), 200 - (rh / 2), rw, rh);
            dataurl = canvas[0].toDataURL('image/png');
            $('#preview-img-blog').attr('src', dataurl);
        }
        img.src = text;
    }
    reader.readAsDataURL(file);
}

function loadSite(site) {
    switch (site) {
        case 'users':
            loadUserSite()
            break
        case 'blogs':
            loadBlogSite()
            break
        case 'partners':
            loadPartnerSite()
            break
        case 'shops':
            loadShopSite()
            break
    }
}

function initSite() {
    initUserSite()
    initBlogSite()
    initPartnerSite()
    initShopSite()
}

function loadUserSite() {
    $('#usr_email').val('')
    $('#usr_password').val('')
    $('.search-input').val('')
    $('#usr_shop-list-holder').empty()
    $('#usr_list-holder').empty()
    $.ajax({
        type: 'POST',
        url: 'Admin_API/getAllShops',
        encode: true,
        success: function (result) {
            result = JSON.parse(result)
            result.forEach(function (element) {
                $('#usr_shop-list-holder').append($('<li class="list-group-item shop-list-item"></li>').text(element['name']).data('id', element['id']))
            }, this)
        },
        error: function (xhr, status, error) {}
    })
    $.ajax({
        type: 'POST',
        url: 'Admin_API/getAllUsers',
        encode: true,
        success: function (result) {
            result = JSON.parse(result)
            result.forEach(function (element) {
                $('#usr_list-holder').append($(`
                    <li class="list-group-item user-list-holder">
                        <p>` + element['email'] + `</p>
                        <p>` + element['shop_id'] + `</p>
                        <button style="width:30%" type="button" class="btn btn-danger">Törlés</button>
                    </li>
                `).data('id', element['id']))
            }, this)
        },
        error: function (xhr, status, error) {}
    })
}

function initUserSite() {
    $('#usr_add-button').click(function () {
        $(this).prop('disabled', true)
        $.ajax({
            type: 'POST',
            url: 'Admin_API/addUser',
            data: {
                email: $('#usr_email').val(),
                password: $('#usr_password').val(),
                shop: $('#usr_shop-list-holder .selected').data('id')
            },
            encode: true,
            success: function (result) {
                loadUserSite()
                $('#usr_add-button').prop('disabled', false)
            },
            error: function (xhr, status, error) {}
        })
    })
    $('#usr_list-holder').on('click', 'button', function () {
        self = $(this)
        $(this).prop('disabled', true)
        $.ajax({
            type: 'POST',
            url: 'Admin_API/deleteUser',
            data: {
                email: self.siblings('p').eq(0).text()
            },
            encode: true,
            success: function (result) {
                loadUserSite()
                self.prop('disabled', false)
            },
            error: function (xhr, status, error) {}
        })
    })
}

function loadBlogSite() {
    $('#blogtitle').val('')
    $('#blogsubtitle').val('')
    $('#blogauthor').val('')
    $('#blogform').data('id', 0)
    $('#preview-img-blog').attr('src', '#')
    $('#textareaholder textarea').remove()
    $('#textareaholder #cke_blogcontent').remove()
    $('#textareaholder').append($('<textarea  id="blogcontent" name="blog-content" rows="10" cols="50" required></textarea>').val(''))
    CKEDITOR.replace('blog-content')
    $('#blog_list-holder').empty()
    $.ajax({
        type: 'POST',
        url: 'Admin_API/getAllBlogs',
        encode: true,
        success: function (result) {
            result = JSON.parse(result)
            result.forEach(function (element) {
                $('#blog_list-holder').append($(`
                    <li class="list-group-item blog-list-holder">
                        <p>` + element['blog_title'] + `</p>
                        <button style="width:30%" type="button" class="btn btn-warning">Szerkeszt</button>
                    </li>
                `).data('blog', element))
            }, this)
        },
        error: function (xhr, status, error) {}
    })
}

function initBlogSite() {
    $('#blog_add-button').click(function () {
        $(this).prop('disabled', true)
        $.ajax({
            type: 'POST',
            url: 'Admin_API/addBlog',
            data: {
                title: $('#blogtitle').val(),
                author: $('#blogauthor').val(),
                content: CKEDITOR.instances['blogcontent'].getData(),
                dataurl: $('#preview-img-blog').attr('src'),
                id: $('#blogform').data('id'),
                subtitle: $('#blogsubtitle').val()
            },
            encode: true,
            success: function (result) {
                console.log(result);
                loadBlogSite()
                $('#blog_add-button').prop('disabled', false)
            },
            error: function (xhr, status, error) {
                console.log(xhr);
            }
        })
    })
    $('#blog_delete-button').click(function () {
        $(this).prop('disabled', true)
        $.ajax({
            type: 'POST',
            url: 'Admin_API/addBlog',
            data: {
                title: '',
                author: '',
                content: '',
                dataurl: '',
                id: $('#blogform').data('id'),
                subtitle: ''
            },
            encode: true,
            success: function (result) {
                console.log(result);
                loadBlogSite()
                $('#blog_add-button').prop('disabled', false)
            },
            error: function (xhr, status, error) {
                console.log(xhr);
            }
        })
    })
    $('#blog_list-holder').on('click', 'button', function () {
        b = $(this).closest('li').data('blog')
        $('#blogtitle').val(b['blog_title'])
        $('#blogsubtitle').val(b['blog_subtitle'])
        $('#blogauthor').val(b['blog_author'])
        $('#blogform').data('id', b['blog_id'])
        $('#preview-img-blog').attr('src', '/assets/images/blogs/' + b['blog_id'] + '.png')
        $('#textareaholder textarea').remove()
        $('#textareaholder #cke_blogcontent').remove()
        $('#textareaholder').append($('<textarea  id="blogcontent" name="blog-content" rows="10" cols="50" required></textarea>').val(b['blog_content']))
        CKEDITOR.replace('blog-content')
    })
    $('#blog-imginput').on('change', function () {
            files = this.files;
            readFileBlog(files[0]);
        });
}

function loadPartnerSite() {
    $('#partner_name').val('')
    $('#partner_link').val('')
    $('#partner_image').val('')
    $('.search-input').val('')
    $('#partner_list-holder').empty()
    $.ajax({
        type: 'POST',
        url: 'Admin_API/getAllPartners',
        encode: true,
        success: function (result) {
            result = JSON.parse(result)
            result.forEach(function (element) {
                $('#partner_list-holder').append($(`
                    <li class="list-group-item user-list-holder">
                        <p>` + element['name'] + `</p>
                        <button style="width:30%" type="button" class="btn btn-danger">Törlés</button>
                    </li>
                `).data('id', element['id']))
            }, this)
        },
        error: function (xhr, status, error) {}
    })
}

function initPartnerSite() {
    $('#partner_add-button').click(function () {
        $(this).prop('disabled', true)
        $.ajax({
            type: 'POST',
            url: 'Admin_API/addPartner',
            data: {
                name: $('#partner_name').val(),
                image: $('#partner_image').val(),
                link: $('#partner_link').val()
            },
            encode: true,
            success: function (result) {
                loadPartnerSite()
                $('#partner_add-button').prop('disabled', false)
            },
            error: function (xhr, status, error) {}
        })
    })
    $('#partner_list-holder').on('click', 'button', function () {
        self = $(this)
        $(this).prop('disabled', true)
        $.ajax({
            type: 'POST',
            url: 'Admin_API/deletePartner',
            data: {
                id: self.closest('li').data('id')
            },
            encode: true,
            success: function (result) {
                loadPartnerSite()
                self.prop('disabled', false)
            },
            error: function (xhr, status, error) {}
        })
    })
}

function loadShopSite() {
    $('#shops').data('edit', 0)
    $('#shop_name').val('')
    $('#shop_link').val('')
    $('#shop_phone').val('')
    $('#shop_facebook').val('')
    $('#shop_image').val('')
    $('#shop_bio').val('')
    $('#label_name').val('')
    $('#shop_partner').prop( "checked", false )
    $('#label_holder li:not(.active)').remove()
    $('#cat_holder li:not(.active)').remove()
    $('#shop_list-holder').empty()
    $('#prod_holder').empty()
    $('#cat_select').empty()
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
        },
        error: function (xhr, status, error) {}
    })
    $.ajax({
        type: 'POST',
        url: 'Admin_API/getAllShops',
        encode: true,
        success: function (result) {
            result = JSON.parse(result)
            result.forEach(function (element) {
                $('#shop_list-holder').append($(`
                    <li class="list-group-item blog-list-holder">
                        <p>` + element['name'] + `</p>
                        <button style="width:30%" type="button" class="btn btn-warning">Szerkeszt</button>
                    </li>
                `).data('shop', element))
            }, this)
        },
        error: function (xhr, status, error) {}
    })
}

function initShopSite() {
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
                loadShopSite()
                $('#shop_add-button').prop('disabled', false)
            },
            error: function (xhr, status, error) {
                loadShopSite()
                $('#shop_add-button').prop('disabled', false)
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
                            </div><div class="pin-product">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div><div class="slide-inner"><div class="product"> <img class='image-responsive' src = "assets/images/products/` + element['imageid'] + `.png">
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
        if(s['pinned'] != 0) {
            $('#shop_partner').prop( "checked", true )
        }
        pins = s['pinned'].split(';')
        if(s['category'] != 0) {
            s['category'].split(';').forEach( function (element) {
                t = $('#cat_select option[value='+element+']').text()
                a = $(`<li class="list-group-item">
                                <div class="delete-row">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </div>
                                <div class="pin-row">
                                    <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                                </div>`+ t +`</li>`)
                if($.inArray(element+'', pins) != -1) {
                    a.addClass('pinned')
                }
                a.data('id',element).appendTo('#cat_holder')
            }, this)
        }
    })
    $(document).on('click', '.delete-row', function() {
        $(this).closest('li').remove()
    })
    $(document).on('click', '.pin-row', function() {
        $(this).closest('li').toggleClass('pinned')
    })
    $(document).on('click', '.pin-product', function() {
        $(this).closest('li').toggleClass('pinned-product')
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
    initSite()
    $('#logout').click(function () {
        window.location = 'Logout'
    })
    $('.tile').click(function () {
        $('.mainmenuholder').hide(300)
        $('#' + $(this).data('menu')).show(300)
        loadSite($(this).data('menu'))
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
    $('.list-holder').on('click', '.shop-list-item', function () {
        if (!$(this).hasClass('selected')) {
            $(this).siblings('.selected').removeClass('selected')
            $(this).addClass('selected')
        } else {
            $(this).removeClass('selected')
        }
    })
    $('.back-btn').click(function () {
        $('.submenuholder').hide(300)
        $('.mainmenuholder').show(300)
    })
})