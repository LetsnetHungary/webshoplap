function editpost() {
    $('#blogform').show(); $('#editpost').hide();
    $.ajax({
            type: 'POST',
            url: 'Admin_API/getBlog',
            data: {
                id: $( ".selectpicker option:selected" ).data('id')
            },
            encode: true,
            success: function (result) {
                console.log(result)
                res = JSON.parse(result)[0]
                console.log(res)
                resetBlog(res['blog_content'])
                $('#blogform').data('id', res['blog_id'])
                $('#blogtitle').val(res['blog_title'])
                $('#blogsubtitle').val(res['blog_subtitle'])
                $('#blogauthor').val(res['blog_author'])
                $('#preview-img-blog').attr('src', '/assets/images/blogs/' +res['blog_id']+ '.png')
            },
            error: function (xhr, status, error) {}
        });
}

function resetBlog(text) {
    $('#blogtitle').val('')
    $('#blogsubtitle').val('')
    $('#blogauthor').val('')
    $('#blogform').data('id', 0)
    $('#preview-img-blog').attr('src', '#')
    $('#textareaholder textarea').remove();
    $('#textareaholder #cke_blogcontent').remove();
    $('#textareaholder').append($('<textarea  id="blogcontent" name="blog-content" rows="10" cols="50" required></textarea>').val(text))
    CKEDITOR.replace('blog-content');
}

function showShop(res) {
    emptyShop();
    $('#newshop').data('pinned', res.pinned);
    $('#newshoptitle').text('Bolt szerkesztése');
    $('#doneshop').hide();
    $('#editshop').show();
    console.log(res)
    $('#shopname').val(res.name);
    $('#adress').val(res.adress);
    $('#phone').val(res.phone);
    $('#image').val(res.image);
    $('#facebook').val(res.facebook);
    $('#bio').val(res.bio);
    $('#labelholder li:not(.active)').remove();
    for (label in res.labels) {
        $('<li class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>' + res.labels[label]["name"] + '</li>').appendTo('#labelholder');
    }
    catsarray = res.category.split('; ')
    for (cat in catsarray) {
        name = $('.leftColumn .boxRow[data-id=' + catsarray[cat] + ']').text();
        $('<li data-id="' + catsarray[cat] + '" class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>' + name + '</li>').appendTo('#categoryholder');
    }
    console.log(res.products);
    for (ind in res.products) {
        product = res.products[ind];
        pinned = false;
        (product['pinned'] == 1) ? pinned = "true": pinned = "false";
        e = $(`<li data-old="true" data-pinned="` + pinned + `" data-id="` + product['id'] + `" class="col-xs-6 col-sm-4 col-md-3"><div class="delete-product">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div><div class="pin-product">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div><div class="slide-inner"><div class="product"> <img class='image-responsive' src = "assets/images/products/` + product['imageid'] + `.png">
                            <div class="price"><h2>` + product['price'] + `Ft<h2></div></div>
                            </div></li>`);
        if (pinned == "true") {
            e.addClass('pinned-product')
        }
        e.appendTo('#productsHolder');

    }
    $('#labelname').val('');
    $('#newshop').show();
    console.log('asd');
    $("html, body").animate({
        scrollTop: $('#newshop').offset().top
    }, 500, 'swing');
}

function emptyShop() {
    $('#shopname').val('');
    $('#adress').val('');
    $('#phone').val('');
    $('#image').val('');
    $('#facebook').val('');
    $('#bio').val('');
    $('#labelholder li:not(.active)').remove();
    $('#categoryholder li:not(.active)').remove();
    $('#productsHolder').empty();
    $('#labelname').val('');
}

function prepareCat(res, self) {
    r = $('.rightColumn');
    r.data('edit', false);
    r.find('.boxTitleEdit').text('Szerkesztés');
    content = $('.rightColumn .boxContent');
    content.empty();
    $(`<div class="boxRowAdd">
                            <button type="button" class="btn btn-success" id="addshop">Új bolt hozzáadása</button>
                        </div>`).appendTo(content);
    for (shop in res) {
        e = $(`<div class="boxRow" data-id="` + res[shop]['id'] + `">` + res[shop]['name'] + ` (` + res[shop]["id"] + `)
                            <div class="delete-row" style="display: none;">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div><div class="pin-row" style="display: none;">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div></div>`);

        arr = res[shop]['pinned'].split('; ');
        if (arr.indexOf($('.rightColumn').data('cat') + "") != -1) {
            e.addClass('pinned-row');
            e.find('.pin-row').addClass('pinned');
        }
        e.appendTo(content);
    }
    $('.rightColumn .boxTitleTitle').text(self.text())
    $('.rightColumn').show().data('id', self.data('id'));
    if ($(window).width() < 992) {
        console.log($('.rightColumn').offset().top);
        $("html, body").animate({
            scrollTop: $('.rightColumn').offset().top
        }, 500, 'swing');
    }
}

function addCategory() {
    if ($('#catname').val() != '') {
        $.ajax({
            type: 'POST',
            url: 'Admin_API/addCategory',
            data: {
                name: $('#catname').val()
            },
            encode: true,
            success: function (result) {
                console.log(result)
                result = JSON.parse(result);
                $('#catname').val('').focus();
                $(`<div class="boxRow" data-id="` + result['id'] + `">
                                ` + result['name'] + `  (` + result["id"] + `)
                                <div class="delete-row" style="display: none">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>`).appendTo('.leftColumn .boxContent');
            },
            error: function (xhr, status, error) {}
        });
    }
}

function addLabel() {
    if ($('#labelname').val() != '') {
        $('<li class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>' + $('#labelname').val() + '</li>').appendTo('#labelholder');
        $('#labelname').val('');
    }
    $('#labelname').focus();
}

function addShop(name, id) {
    $(`<div class="boxRow" data-id="` + id + `">` + name + ` (` + id + `)
                            <div class="delete-row" style="display: none;">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div><div class="pin-row" style="display: none;">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div></div>`).appendTo($('.rightColumn .boxContent'));
    emptyShop();
    $('#newshop').hide();
}

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
            console.log('hello')
            $('#preview-img').attr('src', dataurl);
        }
        img.src = text;
    }
    reader.readAsDataURL(file);
}

function readBlogFile(file) {
    reader = new FileReader();
    reader.onload = function (e) {
        text = e.target.result;
        img = new Image();
        img.onload = function () {
            $('#preview-img-blog').attr('src', text);
            $('#dataurl').val(text)
        }
        img.src = text;
    }
    reader.readAsDataURL(file);
}

function clearImage() {
    $('#preview-img').attr('src', '#');
    $('#prodprice').val('')
    $('#prodname').val('')
    $('#prodlink').val('')
    $('#prod-imginput').replaceWith($('<input class="file" id="prod-imginput" type="file" accept="image/*">'));
}
$(function () {
    $('#newps').click(function () {
        idp = $('#newpid').val()
        $('#newpid').val('')
        $.ajax({
                type: 'POST',
                url: 'Admin_API/addPartnerShop',
                data: {
                    id: idp
                },
                success: function (result) {

                },
                error: function (xhr, status, error) {}
            })
    })
    $('#remps').click(function () {
    idp = $('#newpid').val()
    $('#newpid').val('')
    $.ajax({
            type: 'POST',
            url: 'Admin_API/remPartnerShop',
            data: {
                id: idp
            },
            success: function (result) {
                
            },
            error: function (xhr, status, error) {}
        })
})
    $('#submitblog').click(function() {
        $('#blogid').val($('#blogform').data('id'))
        $('#blogform').submit();
    })
    resetBlog('')
    $('#editpost').click(function() {
        editpost();
    })
    $('#addCat').click(function () {
        $('<li data-id="' + $('#catselect').val() + '" class="list-group-item"><div class="delete-row"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>' + $('#catselect option:selected').text() + '</li>').appendTo('#categoryholder');
    });
    $('#productsHolder').data('deleted', []);
    $('.add-row').click(function () {
        clearImage();
        $('#uploadcontainer').toggle()
    })
    $('#addproduct').click(function () {
        $(`<li class="col-xs-6 col-sm-4 col-md-3"><div class="delete-product">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                            </div><div class="pin-product">
                                <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                            </div><div class="slide-inner"><div class="product"> <img class='image-responsive' src = "` +
            $('#preview-img').attr('src') + `">
                            <div class="price"><h2>` + $('#prodprice').val() + `Ft<h2></div></div>
                            </div></li>`).data('price', $('#prodprice').val()).data('name', $('#prodname').val()).data('link', $('#prodlink').val()).appendTo('#productsHolder');
        clearImage();
    });
    $('.container').on('change', '#prod-imginput', function () {
        files = this.files;
        readFile(files[0]);
    });
    $('.container').on('change', '#blog-imginput', function () {
        files = this.files;
        readBlogFile(files[0]);
    });
    $('#preview-img').click(function () {
        $('#prod-imginput').click();
    })
    $('#preview-img-blog').click(function () {
        $('#blog-imginput').click();
    })
    $('#productsHolder').sortable({
        placeholder: "ui-state-highlight slide-inner placeholder col-xs-6 col-sm-4 col-md-3"
    });
    $('.container').on('click', '.leftColumn .boxRow', function (e) {
        if (!$(e.target).hasClass('delete-row') && !$(e.target).hasClass('fa-times')) {
            self = $(this)
            $.ajax({
                type: 'POST',
                url: 'Admin_API/getShops',
                data: {
                    id: self.data('id')
                },
                encode: true,
                success: function (result) {
                    res = JSON.parse(result)
                    $('.rightColumn').data('cat', self.data('id'));
                    prepareCat(res, self);
                },
                error: function (xhr, status, error) {}
            });
        } else {
            self = $(this)
            $.ajax({
                type: 'POST',
                url: 'Admin_API/removeCategory',
                data: {
                    id: self.data('id')
                },
                encode: true,
                success: function (result) {
                    if (self.data('id') == $('.rightColumn').data('id')) {
                        $('.rightColumn').hide();
                    }
                    self.closest('.boxRow').remove();
                },
                error: function (xhr, status, error) {}
            });
        }
    });

    $('.container').on('click', '.rightColumn .boxRow', function (e) {
        if (!$(e.target).hasClass('delete-row') && !$(e.target).hasClass('fa-times') &&
            !$(e.target).hasClass('pin-row') && !$(e.target).hasClass('fa-thumb-tack')) {
            self = $(this)
            $.ajax({
                type: 'POST',
                url: 'Admin_API/getShop',
                data: {
                    id: self.data('id')
                },
                encode: true,
                success: function (result) {
                    res = JSON.parse(result)
                    showShop(res)
                    $('#newshop').data('id', self.data('id'))
                },
                error: function (xhr, status, error) {}
            });
        } else if ($(e.target).hasClass('delete-row') || $(e.target).hasClass('fa-times')) {
            self = $(this)
            $.ajax({
                type: 'POST',
                url: 'Admin_API/removeShop',
                data: {
                    id: self.data('id')
                },
                encode: true,
                success: function (result) {
                    self.closest('.boxRow').remove();
                },
                error: function (xhr, status, error) {}
            });
        } else {
            self = $(this)

            $.ajax({
                type: 'POST',
                url: 'Admin_API/pinShop',
                data: {
                    id: self.data('id'),
                    pin: self.closest('.boxRow').find('.pin-row').hasClass('pinned') ? 0 : 1,
                    cat: $('.rightColumn').data('cat')
                },
                encode: true,
                success: function (result) {
                    console.log(result)
                    el = self.closest('.boxRow').find('.pin-row');
                    if (el.hasClass('pinned')) {
                        self.closest('.boxRow').removeClass('pinned-row').find('.pin-row').removeClass('pinned')
                    } else {
                        self.closest('.boxRow').addClass('pinned-row').find('.pin-row').addClass('pinned');
                        self.closest('.boxRow').clone().insertAfter('.rightColumn .boxRowAdd');
                        self.closest('.boxRow').remove();
                    }
                },
                error: function (xhr, status, error) {}
            });
        }
    });
    $('.boxTitle').on('click', function () {
        parent = $(this).closest('.col-md-6');
        if (parent.data('edit')) {
            parent.find('.delete-row').hide();
            parent.find('.pin-row').hide();
            parent.data('edit', false);
            $(this).find('.boxTitleEdit').text('Szerkesztés');
        } else {
            parent.find('.delete-row').show();
            parent.find('.pin-row').show();
            parent.data('edit', true);
            $(this).find('.boxTitleEdit').text('Kész');
        }
    });
    $('#addcat').on('click', function () {
        addCategory();
    });
    $('#catname').keypress(function (e) {
        if (e.which == 13) {
            $(this).blur();
            $('#addcat').focus().click();
        }
    });
    $('.container').on('click', '#addshop', function () {
        emptyShop();
        $('#newshoptitle').text('Új bolt hozzáadása');
        $('#doneshop').show();
        $('#editshop').hide();
        $('#newshop').show();
        $("html, body").animate({
            scrollTop: $('#newshop').offset().top
        }, 500, 'swing');
    });

    $('#addlabel').on('click', function () {
        addLabel();
    });
    $('#labelname').keypress(function (e) {
        if (e.which == 13) {
            $(this).blur();
            $('#addlabel').focus().click();
        }
    });
    $('.container').on('click', 'li .delete-row', function () {
        $(this).closest('li').remove();
    });
    $('#editshop').on('click', function () {
        shop = new Object();
        shop.name = $('#shopname').val();
        shop.adress = $('#adress').val();
        shop.phone = $('#phone').val();
        shop.image = $('#image').val();
        shop.facebook = $('#facebook').val();
        shop.bio = $('#bio').val();
        shop.id = $('#newshop').data('id');
        cats = [];
        $('#categoryholder li:not(:first)').each(function () {
            cats.push($(this).data('id'))
        })
        shop.category = cats.join('; ');
        shop.pinned = $('#newshop').data('pinned');
        shop.labels = new Array();
        $('#labelholder li:not(.active)').each(function (index, elem) {
            shop.labels.push($(this).text());
        });
        shop.deleted = $('#productsHolder').data('deleted');
        shop.products = new Array();
        i = 0;
        $('#productsHolder li').each(function () {
            prod = new Object();
            if ($(this).attr('data-old')) {
                prod.type = 'old';
                prod.id = $(this).data('id')
            } else {
                prod.type = 'new'
            }
            prod.image = $(this).find('img').attr('src');
            prod.price = $(this).data('price')
            prod.name = $(this).data('name')
            prod.link = $(this).data('link')
            prod.position = i;
            i += 1;
            shop.products.push($.extend(true, {}, prod));
            prod = "";
        })
        $.ajax({
            url: 'Admin_API/updateShop',
            type: 'POST',
            data: {
                shop: JSON.stringify(shop)
            },
            dataType: 'json',
            encode: true,
            success: function (result) {
                $('.rightColumn .boxRow').each(function () {
                    if ($(this).data('id') == $('#newshop').data('id')) {
                        e = $(`<div class="boxRow" data-id="` + result["id"] + `">` + result["name"] + ` (` + result["id"] + `)
                                    <div class="delete-row" style="display: none;">
                                        <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                    </div><div class="pin-row" style="display: none;">
                                        <i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i>
                                    </div></div>`).insertAfter($(this));
                        arr = $('#newshop').data('pinned').split('; ');
                        if (arr.indexOf($('.rightColumn').data('cat') + "") != -1) {
                            e.addClass('pinned-row').find('.pin-row').addClass('pinned');
                        }
                        $(this).remove();
                    }
                })
                emptyShop();
                $('#newshop').hide();

            },
            error: function (xhr, status, error) {
                console.log(xhr)
            }
        });
    });
    $('#editshop2').on('click', function () {
        shop = new Object();
        shop.name = $('#shopname').val();
        shop.adress = $('#adress').val();
        shop.phone = $('#phone').val();
        shop.image = $('#image').val();
        shop.facebook = $('#facebook').val();
        shop.bio = $('#bio').val();
        shop.id = $('#newshop').data('id');
        cats = [];
        $('#categoryholder li:not(:first)').each(function () {
            cats.push($(this).data('id'))
        })
        shop.category = cats.join('; ');
        shop.pinned = $('#newshop').data('pinned');
        shop.labels = new Array();
        $('#labelholder li:not(.active)').each(function (index, elem) {
            shop.labels.push($(this).text());
        });
        shop.deleted = $('#productsHolder').data('deleted');
        shop.products = new Array();
        i = 0;
        $('#productsHolder li').each(function () {
            prod = new Object();
            if ($(this).attr('data-old')) {
                prod.type = 'old';
                prod.id = $(this).data('id')
            } else {
                prod.type = 'new'
            }
            prod.image = $(this).find('img').attr('src');
            prod.price = $(this).data('price')
            prod.name = $(this).data('name')
            prod.link = $(this).data('link')
            prod.position = i;
            i += 1;
            shop.products.push($.extend(true, {}, prod));
            prod = "";
        })
        $.ajax({
            url: 'Admin_API/updateShop',
            type: 'POST',
            data: {
                shop: JSON.stringify(shop)
            },
            dataType: 'json',
            encode: true,
            success: function (result) {

            },
            error: function (xhr, status, error) {
                console.log(xhr)
            }
        });
    });
    $('#doneshop').on('click', function () {
        shop = new Object();
        shop.name = $('#shopname').val();
        shop.adress = $('#adress').val();
        shop.phone = $('#phone').val();
        shop.image = $('#image').val();
        shop.facebook = $('#facebook').val();
        shop.bio = $('#bio').val();
        shop.labels = new Array();
        $('#labelholder li:not(.active)').each(function (index, elem) {
            shop.labels.push($(this).text());
        });
        cats = [];
        $('#categoryholder li:not(:first)').each(function () {
            cats.push($(this).data('id'))
        })
        shop.category = cats.join('; ');
        shop.products = new Array();
        i = 0;
        $('#productsHolder li').each(function () {
            prod = new Object();
            $(this).attr('data-old') ? prod.type = 'old' : prod.type = 'new';
            prod.image = $(this).find('img').attr('src');
            prod.price = $(this).data('price')
            prod.name = $(this).data('name')
            prod.link = $(this).data('link')
            prod.position = i;
            i += 1;
            shop.products.push($.extend(true, {}, prod));
            prod = "";
        })
        console.log('eddik ok')
        $.ajax({
            url: 'Admin_API/addShop',
            type: 'POST',
            data: {
                shop: JSON.stringify(shop)
            },
            dataType: 'json',
            encode: true,
            success: function (result) {
                addShop(result["name"], result["id"]);

            },
            error: function (xhr, status, error) {}
        });
    })
    $('#addnewusr').click(function () {
        $('#newusrform .form-group').toggle();
        $(this).hide();
        $('#doneusr').show();
    });
    $('#addp').click(function () {
        $('#newpform .form-group').toggle();
        $(this).hide();
        $('#donep').show();
    });
    $('.container').on('click', '.delete-product', function () {
        parent = $(this).closest('li')
        if (parent.data('old')) {
            $('#productsHolder').data('delted', $('#productsHolder').data('deleted').push(parent.data('id')))
        }
        parent.remove();
        console.log($('#productsHolder').data('deleted'))
    })

    $('#showpartners').click(function() {
        $(this).hide()
        $.ajax({
            url: 'Admin_API/showPartners',
            type: 'POST',
            data: {},
            encode: true,
            success: function (result) {
                console.log(result)
                var json = JSON.parse(result)
                json.forEach(function(partner) {
                    var html = "<div> <span>" + partner.name + "</span> <input class='partner_link' value='" + partner.url + "' id='" + partner.id + "'> <button class='deletePartner new-user-btn btn btn-danger' id='" + partner.id + "'> Törlés! </button>  </div>"
                    $("#p_holder").append(html)
                })
            },
            error: function (xhr, status, error) {}
        });
    })

    $(document).on('click', '.deletePartner', function () {
        $.ajax({
            url: 'Admin_API/deletePartner',
            type: 'POST',
            data: {
                id: $(this).attr('id')
            },
            success: function (result) {
                alert("Sikeresen töröltél egy partnert!")
                location.reload()
            },
            error: function (xhr, status, error) {}
        });
    })

    $(document).on('change', '.partner_link', function () {

        $.ajax({
            url: 'Admin_API/refreshPartnerURL',
            type: 'POST',
            data: {
                id: $(this).attr('id'),
                url: $(this).val()
            },
            success: function (result) {
                alert('Sikeresen updatelted a partner linkjét!')
            },
            error: function (xhr, status, error) {}
        });
    })

    $('#handleusers').click(function() {
        $(this).hide()
        $.ajax({
            url: 'Admin_API/handleusers',
            type: 'POST',
            data: {},
            encode: true,
            success: function (result) {
                console.log(result)
                var json = JSON.parse(result)
                json.forEach(function(user) {
                    var html = "<li> <input type='text' class='usremailc' id='" + user.id + "' value='" + user.email + "'> <input type='password' class='usrpasswdc' id='" + user.id + "'> <input type='text' class='usrshopc' id='" + user.id + "' value='" + user.name + "'> <button id='" + user.id + "' type='submit' class='deleteusrc btn btn-danger'>Törlés!</button></li>"
                    $("#usersholder").append(html)
                    //$("#usersholder").toggle()
                })
            },
            error: function (xhr, status, error) {}
        });
    })

    $(document).on('change', '.usremailc', function () {

        $.ajax({
            url: 'Admin_API/refreshUserEmail',
            type: 'POST',
            data: {
                id: $(this).attr('id'),
                email: $(this).val()
            },
            success: function (result) {
                console.log(result)
                alert('Sikeresen updatelted a user emailjét!')
            },
            error: function (xhr, status, error) {}
        });
    })

    $(document).on('change', '.usrpasswdc', function () {

        $.ajax({
            url: 'Admin_API/refreshUserPassword',
            type: 'POST',
            data: {
                id: $(this).attr('id'),
                password: $(this).val()
            },
            success: function (result) {
                console.log(result)
                alert('Sikeresen updatelted a user jelszavát!')
            },
            error: function (xhr, status, error) {}
        });
    })

    $(document).on('click', '.deleteusrc', function () {
        $.ajax({
            url: 'Admin_API/deleteUser',
            type: 'POST',
            data: {
                id: $(this).attr('id')
            },
            success: function (result) {
                console.log(result)
                alert("Sikeresen töröltél egy usert!")
                location.reload()
            },
            error: function (xhr, status, error) {}
        });
    })

    $(document).on('change', '.usrshopc', function () {

        $.ajax({
            url: 'Admin_API/refreshUserShop',
            type: 'POST',
            data: {
                id: $(this).attr('id'),
                shop: $(this).val()
            },
            success: function (result) {
                console.log(result)
                alert('Sikeresen updatelted a userhez tartozó boltot!')
            },
            error: function (xhr, status, error) {}
        });
    })










    $('.container').on('click', '.pin-product', function () {
        parent = $(this).closest('li')
        pin = (parent.data('pinned')) ? 0 : 1;
        $.ajax({
            url: 'Admin_API/pinProduct',
            type: 'POST',
            data: {
                id: parent.data('id'),
                pin: pin
            },
            encode: true,
            success: function (result) {
                (pin == 1) ? parent.data('pinned', true): parent.data('pinned', true);
                (pin == 1) ? parent.addClass('pinned-product'): parent.removeClass('pinned-product');
            },
            error: function (xhr, status, error) {}
        });
    })
});