const datas = JSON.parse(localStorage.getItem('item_faktur_beli'))

let table;
table = $('#table').DataTable({
    "responsive": false,
    "pagingType": "simple_numbers",
    "paging": false,
    "autoWidth": true,
    "scrollX": true,
    "scrollCollapse": true,
    "columnDefs": [
        { "width": '50px', "targets": 0 },
        { "width": '100px', "targets": 1 },
        { "width": '100px', "targets": 2 },
        { "width": '200px', "targets": 3 },
        { "width": '200px', "targets": 4 },
        { "width": '150px', "targets": 5 },
        { "width": '150px', "targets": 6 },
        { "width": '150px', "targets": 7 },
        { "width": '50px', "targets": 8 },
    ],
    "fixedColumns": true,
    "scrollY": "310px",
    'pageLength': 10,
    "lengthMenu": [10, 25, 50, 100],
    "order": [['5', 'desc']],
    "processing": true,
    "bInfo" : false,
    "language": {
        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
    },
    "searching": false,
})

function createItems() {
    const tr = document.createElement('tr')
    const randid = makeid(4)
    tr.classList.add('mb-4')
    tr.classList.add('item')
    tr.classList.add(`item-${randid}`)

    let countNumber = document.querySelectorAll('.item').length
    countNumber++

    tr.innerHTML =  `
        <td class="number-table" id="number-${randid}">${countNumber}</td>
        <td><input type="number" class="form-control form-control-sm qty-item qty-item-${randid}" name="banyak[]" value="1" data-item="${randid}"></td>
        <td><select class="form-control form-control-sm satuan-barang satuan-item-${randid}" name="satuan[]"></select></td>
        <td><select class="form-control form-control-sm select2 get-item kode-item-${randid}" name="barang[]" data-item="${randid}"></td>
        <td><select class="form-control form-control-sm select2 get-item nama-item-${randid}" data-item="${randid}"></select></td>
        <td><input type="number" class="form-control form-control-sm harga-item harga-item-${randid}" name="harga[]" value="0" readonly></td>
        <td><input type="number" class="form-control form-control-sm diskon-item diskon-item-${randid}" name="diskon[]" value="0" max="100" data-item="${randid}" readonly></td>
        <td><input type="number" class="form-control form-control-sm total-item total-item-${randid}" name="total[]" value="0" readonly></td>
        <td><button type="button" class="btn btn-danger btn-sm delete-item delete-item-${randid}" data-item="${randid}"><span class="fa fa-trash"></span></button></td>
    `

    table.rows.add($(tr)).draw(false)

    getItems(randid)
    satuan()
    getCode(randid)
    $(function () {
        $('.select2').select2({})
    })

}

function deleteItem(data) {
    let check = false;
    let item = 0;
    let fakturs = JSON.parse(localStorage.getItem('item_faktur_beli'));
    for (let i = 0; i < fakturs.length; i++) {
        if (data == fakturs[i].barang) {
            check = true;
            item = i;
            break;
        }
    }
    if (check) {
        fakturs.splice(item, 1);
        localStorage.setItem('item_faktur_beli', JSON.stringify(fakturs));
    }
}

function getCode(code) {
    document.getElementById('code-el').value = code
}

function itemFaktur(item) {
    let items = JSON.parse(localStorage.getItem('item_faktur_beli')) || [];

    items.push(item);

    localStorage.setItem('item_faktur_beli', JSON.stringify(items));
}

function fakturUpdate(data, qty) {
    let check = false;
    let item = 0;
    let items = JSON.parse(localStorage.getItem('item_faktur_beli'));
    for (let i = 0; i < items.length; i++) {
        if (data.barang === items[i].barang) {
            check = true;
            item = i;
            break;
        }
    }
    if (check) {
        items[item].qty = qty;
        localStorage.setItem('item_faktur_beli', JSON.stringify(items));
    } else {
        itemFaktur(data);
    }
}

$('body').on('contextmenu', '#table-item', function () {
    if (localStorage.getItem('item_faktur_beli') == null) {
        let items = [];

        items.push();

        localStorage.setItem('item_faktur_beli', JSON.stringify(items));
    }
    createItems()
    return false
})

$('body').on('click', '#add-item-faktur', function () {
    if (localStorage.getItem('item_faktur_beli') == null) {
        let items = [];

        items.push();

        localStorage.setItem('item_faktur_beli', JSON.stringify(items));
    }
    createItems()
    return false
})

$('body').on('keyup keydown', '#bayar', function () {
    let bayar   = $(this).val()
    let price   = $('body').find('#total-inpt').val()
    let total   = bayar - price

    $('body').find('#kembali').val(total)
})

$('body').on('click', '.delete-item', function () {
    let faktur = $(this).data('faktur')

    table.row($(this).parents('tr')).remove().draw();
    // $(this).parents('.item').remove()
    deleteItem(faktur)
    checkNumber()

    setTimeout(() => {
        subTotalEl()
        totalQTY()
        total()
    }, 500)
})

$('body').on('click', '#delete-items', function () {
    $('body').find('.item').remove()
    localStorage.clear()
    setTimeout(() => {
        subTotalEl()
        totalQTY()
        total()
    }, 500)
})

$('body').on('click', '.item', function () {
    let image = $(this).data('img')

    if(image) {
        $('body').find('#img-item').attr('src', image)
    }
})

$('body').on('change', '.get-item', function () {
    let barangId      = $(this).val()
    let elid          = $(this).data('item')
    let faktur        = $('body').find('.delete-item-'+ elid).data('faktur')
    let qty           = $('body').find('.qty-item-'+ elid).val()

    deleteItem(faktur)

    if (barangId) {
        $.ajax({
            url: '/api/v1/master-data/barang/' + barangId,
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let image         = data[2]
                let harga         = data[0]
                let diskon        = data[1] * qty
                let totalHarga    = 0
                if (diskon > 1) {
                    totalHarga    = harga * qty - diskon
                } else {
                    totalHarga    = harga * qty
                }

                $('body').find('.kode-item-'+ elid).val(barangId).trigger('change.select2')
                $('body').find('.nama-item-'+ elid).val(barangId).trigger('change.select2')
                $('body').find('.harga-item-'+ elid).val(harga)
                $('body').find('.diskon-item-'+ elid).val(diskon)
                $('body').find('.total-item-'+ elid).val(totalHarga)

                $('body').find('#img-item').attr('src', image)
                $('body').find('.item-'+ elid).data('img', image)

                $('body').find('.delete-item-'+ elid).attr('data-faktur', barangId)

                let fakturData  = {
                    "barang": barangId,
                    "qty": parseInt(qty)
                }

                if (localStorage.getItem('item_faktur_beli') == null) {
                    itemFaktur(fakturData)
                    let fakturs = JSON.parse(localStorage.getItem('item_faktur_beli')).length
                    if(fakturs == 0) {
                        itemFaktur(fakturData)
                    }
                } else {
                    fakturUpdate(fakturData, parseInt(qty));
                }

                subTotalEl()
                totalQTY()
                total()
            }
        })
    }
})

$('body').on('keyup mouseup', '.qty-item', function () {
    let elid          = $(this).data('item')
    let qty           = $(this).val() != "" ? $(this).val() : 0
    let barangId      = $('body').find('.kode-item-' + elid).val()

    if (barangId) {
        $.ajax({
            url: '/api/v1/master-data/barang/' + barangId,
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let image         = data[2]
                let harga         = data[0]
                let diskon        = data[1] * qty
                let totalHarga    = 0
                if (diskon > 1) {
                    totalHarga    = harga * qty - diskon
                } else {
                    totalHarga    = harga * qty
                }

                $('body').find('.harga-item-'+ elid).val(harga)
                $('body').find('.diskon-item-'+ elid).val(diskon)
                $('body').find('.total-item-'+ elid).val(totalHarga)

                $('body').find('#img-item').attr('src', image)

                let fakturData  = {
                    "barang": barangId,
                    "qty": parseInt(qty)
                }

                if (localStorage.getItem('item_faktur_beli') == null) {
                    itemFaktur(fakturData)
                    let fakturs = JSON.parse(localStorage.getItem('item_faktur_beli')).length
                    if(fakturs == 0) {
                        itemFaktur(fakturData)
                    }
                } else {
                    fakturUpdate(fakturData, parseInt(qty));
                }

                subTotalEl()
                totalQTY()
                total()
            }
        })
    }
})

$('body').on('input', '.cost', function () {
    setTimeout(() => {
        total()
    }, 300)
})

$('body').on('change', '#ppn', function () {
    if(this.checked) {
        let subTotal = parseInt($('#sub-total').val()) - parseInt($('#potongan-input').val())
        let ppn = hitungPotongan(subTotal, 11)
        $('#ppn-input').val(ppn)
    } else {
        $('#ppn-input').val(0)
    }

    total()
})

$('body').on('submit', '#form-validation-transaksi', function () {
    localStorage.clear()
})

$('body').on('keyup keydown', '#potongan', function () {
    let disc = $(this).val()
    let subTotal = $('#sub-total').val()
    let potongan = hitungPotongan(subTotal, disc)

    if($('#ppn').is(':checked')) {
        let ppn = hitungPotongan(parseInt(subTotal) - parseInt(potongan), 11)
        $('#ppn-input').val(ppn)
    } else {
        $('#ppn-input').val(0)
    }

    $('#potongan-input').val(potongan)
    total()
})

$('body').on('keyup keydown', '#potongan-input', function () {
    let potongan = $(this).val()
    let subTotal = $('#sub-total').val()
    let persen = hitungPersen(potongan, subTotal)

    if($('#ppn').is(':checked')) {
        let ppn = hitungPotongan(parseInt(subTotal) - parseInt(potongan), 11)
        $('#ppn-input').val(ppn)
    } else {
        $('#ppn-input').val(0)
    }

    $('#potongan').val(parseInt(persen))
    total()
})

$('body').on('change',  '#jenis-pembayaran', function () {
    let val = $(this).val()
    if(val == "Cash") {
        $('body').find('#pay').attr('readonly', false)
        $('body').find('#pay').val('0')
    } else {
        let total = $('body').find('#total-inpt').val()
        $('body').find('#pay').attr('readonly', true)
        $('body').find('#pay').val(total)
    }
})

$('#btn-reload').on('click', function () {
    $('body').find('.item').remove()
    fetchData()
})

function satuan() {
    let options = `
        <option value="pcs">pcs</option>
    `
    // <option value="lusin">lusin</option>
    // <option value="kodi">kodi</option>

    $('body').find('.satuan-barang').html(options)
}

function hitungDiskon(harga, persen) {
    let result = harga - (harga * (persen / 100));

    return result
}

function hitungPotongan(harga, persen) {
    let result = harga * (persen / 100);

    return result
}

function hitungPersen(value, total) {
    return (100 * value) / total;
}

function numberFormat(number, prefix){
    var number_string = number.replace(/[^,\d]/g, '').toString(),
    split   = number_string.split(','),
    over    = split[0].length % 3,
    rupiah  = split[0].substr(0, over),
    thousand  = split[0].substr(over).match(/\d{3}/gi);

    if(thousand){
        separator = over ? '.' : '';
        rupiah += separator + thousand.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
}

function makeid(length) {
    let result           = '';
    let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let charactersLength = characters.length;
    for ( let i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function subTotalEl() {
    const subTotal = document.getElementById('sub-total')
    const totalEls = document.querySelectorAll('.total-item')
    const arr = []
    const reducer = (accumulator, currentValue) => accumulator + currentValue;

    totalEls.forEach(totalEl => arr.push(parseInt(totalEl.value)))

    const totalHarga = arr < 1 ? 0 : arr.reduce(reducer)

    subTotal.value = totalHarga
}

function total() {
    const totalText     = document.getElementById('total')
    const totalInpt     = document.getElementById('total-inpt')
    const potongan      = document.getElementById('potongan-input').value
    const ppn           = document.getElementById('ppn-input').value
    const subTotal      = document.getElementById('sub-total').value
    const nominalHtng   = document.getElementById('nominal-hutang')

    let total = parseInt(subTotal) - parseInt(potongan) + parseInt(ppn)

    totalText.value = numberFormat(total.toString(), "Rp ")
    totalInpt.value = total
    nominalHtng.value = total
}

function totalQTY() {
    const total = document.getElementById('total-qty')
    const qtyEl = document.querySelectorAll('.qty-item')
    const arr = []
    const reducer = (accumulator, currentValue) => accumulator + currentValue;

    qtyEl.forEach(qty => arr.push(parseInt(qty.value)))

    const totalQTY = arr < 1 ? 0 : arr.reduce(reducer)

    total.value = totalQTY
}

fetchData()
function fetchData() {
    if(datas) {
        datas.forEach(data => getFaktur(data.barang, data.qty))
    }
}

function getFaktur(barangId, qty) {
    $.ajax({
        url: '/api/v1/master-data/barang/' + barangId,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            listFaktur(data[0], data[1], qty, barangId, data[2])
        }
    })
}

const listFaktur = (hargaBeli, hargaDiskon, qty, barangId, img) => {
    const tr = document.createElement('tr')
    const randid = makeid(4)
    tr.classList.add('mb-4')
    tr.classList.add('item')
    tr.classList.add(`item-${randid}`)
    tr.setAttribute('data-img', img)

    let harga         = hargaBeli
    let diskon        = hargaDiskon * qty
    let totalHarga    = 0
    if (diskon > 1) {
        totalHarga    = harga * qty - diskon
    } else {
        totalHarga    = harga * qty
    }

    let countNumber = document.querySelectorAll('.item').length
    countNumber++

    tr.innerHTML =  `
        <td class="number-table" id="number-${randid}">${countNumber}</td>
        <td><input type="number" class="form-control qty-item qty-item-${randid}" name="banyak[]" value="${qty}" data-item="${randid}"></td>
        <td><select class="form-control satuan-barang satuan-item-${randid}" name="satuan[]"></select></td>
        <td><select class="form-control select2 get-item kode-item-${randid}" name="barang[]" data-item="${randid}"></td>
        <td><select class="form-control select2 get-item nama-item-${randid}" data-item="${randid}"></select></td>
        <td><input type="number" class="form-control harga-item harga-item-${randid}" name="harga[]" value="${harga}" min="0" data-item="${randid}"></td>
        <td><input type="number" class="form-control diskon-item diskon-item-${randid}" name="diskon[]" value="${diskon}" max="100" data-item="${randid}" readonly></td>
        <td><input type="number" class="form-control total-item total-item-${randid}" name="total[]" value="${totalHarga}" readonly></td>
        <td><button type="button" class="btn btn-danger btn-sm delete-item delete-item-${randid}" data-item="${randid}" data-faktur="${barangId}"><span class="fa fa-trash"></span></button></td>
    `

    table.rows.add($(tr)).draw(false)

    getItems(randid, barangId)
    satuan()
    getCode(randid)
    $(function () {
        $('.select2').select2({})
    })

    subTotalEl()
    totalQTY()
    total()
}

function getItems(randid, barangId) {
    $.ajax({
        url: '/api/v1/master-data/barang',
        dataType: 'json',
        method: 'GET',
        success: function (data) {
            let code = ''
            let name = ''
            code += '<option value="">- Barcode -</option>'
            name += '<option value="">- Cari Nama Barang -</option>'
            $.each(data, function () {
                code += '<option value="'+ this.id +'">'+ this.kode +'</option>'
            })
            $.each(data, function () {
                name += '<option value="'+ this.id +'">'+ this.nama +'</option>'
            })
            $('body').find('.kode-item-'+ randid).html(code)
            $('body').find('.nama-item-'+ randid).html(name)

            if(barangId != null) {
                $('body').find('.kode-item-'+ randid).val(barangId).trigger('change.select2')
                $('body').find('.nama-item-'+ randid).val(barangId).trigger('change.select2')
            }
        }
    })
}

function checkNumber() {
	element = document.querySelectorAll('.number-table');
    element.forEach((el, key) => {
        id = el.id
        document.getElementById(id).innerHTML = key + 1
    })
}