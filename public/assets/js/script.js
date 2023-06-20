//ckeditor
var img = document.getElementById('image');
$(document).on('click', '#image', function () {
    selectFileWithCKFinder('input_img');
})
function selectFileWithCKFinder(elementId) {
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                var output = document.getElementById(elementId);
                var name_file = document.getElementById('name_file');
                output.value = file.getUrl();
                name_file.value = 'Selected: ' + escapeHtml(file.get('name'));
            });

            finder.on('file:choose:resizedImage', function (evt) {
                var output = document.getElementById(elementId);
                output.value = evt.data.resizedUrl;
            });
        }
    });
}


function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}



$(document).ready(function () {
    $('#validate_form_cr').parsley();
})

//search column
function searchColumsDataTable(datatable) {
    datatable.api().columns([1, 2, 3]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 3) {
            input.setAttribute('type', 'date');
        } else if (column.selector.cols == 2) {
            input = document.createElement("select");
            createSelectColumnUniqueDatatableAll(input, column);
        }
        input.setAttribute('placeholder', 'Nhập từ khoá...');
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}

function searchColumsDataTableProjects(datatable) {
    datatable.api().columns([1, 2, 3, 4, 5, 6, 7]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 4) {
            input.setAttribute('type', 'date');
        } else if (column.selector.cols == 6) {
            input = document.createElement("select");
            createSelectColumnUniqueDatatableAll(input, column);
        } else if (column.selector.cols == 5) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">Tất cả</option>');
            column.data().unique().sort().each(function (d, j) {
                $(input).append('<option value=' + d + '>' + d + '</option>');
            });
        }
        input.setAttribute('placeholder', 'Nhập từ khoá...');
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}

function searchColumsDataTableProjectsReport(datatable) {
    datatable.api().columns([1, 2, 3, 4, 5, 6]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 4) {
            input.setAttribute('type', 'date');
        } else if (column.selector.cols == 6) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">Tất cả</option>');
            column.data().unique().sort().each(function (d, j) {
                $(input).append('<option value=' + j + '>' + d + '</option>');
            });
        }
        input.setAttribute('placeholder', 'Enter keywords');
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}

function appentTo() {
    $('#projects-table tfoot tr').appendTo('#projects-table thead');
    $('#projectreport-table tfoot tr').appendTo('#projectreport-table thead');
}

function createSelectColumnUniqueDatatableAll(input, column) {
    input.setAttribute('class', 'form-select');
    $(input).append('<option value="">Tất cả</option>');
    column.data().unique().sort().each(function (d, j) {
        $(input).append('<option value=' + j + '>' + d + '</option>');
    });
}



//destroy
$(document).on('click', '.open-modal-delete', function () {
    var form = $("#modalFormDelete"),
        action = $(this).data('route');
    form.attr('action', action);
});

//select2
$(document).ready(function () {
    $('#project_report').select2({
        placeholder: 'Chọn dự án...',
    });
    $('#employee_report').select2({
        placeholder: 'Chọn nhân viên...',
    });
})

//visible/ ẩn hiện cột datatables
$(document).ready(function () {
    columns = window.LaravelDataTables["projects-table"].columns();
    toggleColumnsDatatable(columns);
});
$(document).ready(function () {
    columns = window.LaravelDataTables["projectreport-table"].columns();
    toggleColumnsDatatable(columns);
});
function toggleColumnsDatatable(columns) {
    var headerColumns = columns.header().map(d => d.textContent).toArray(),
        htmlToggleColumns = '',
        checked;
    $.each(headerColumns, function (index, value) {
        checked = '';
        if (columns.column(index).visible() === true) {
            checked = 'checked';
        }
        htmlToggleColumns +=
            `
        <label class="dropdown-item"><input class="toggle-vis form-check-input m-0 me-2" ${checked} type="checkbox" data-column="${index}">${value}</label> `;
        $(".drop-toggle-columns").html(htmlToggleColumns);
    });
}
$(document).on('change', 'input.toggle-vis', function (e) {
    e.preventDefault();
    var column = columns.column($(this).attr('data-column'));
    column.visible(!column.visible());
});
