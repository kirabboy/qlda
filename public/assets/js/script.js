//ckeditor
$(document).on('click', '#file_upload_project', function () {
    selectFileWithCKFinderProject('input_img_project');
})
$(document).on('click', '#image', function () {
    selectFileWithCKFinder('input_img', 'file_path', 'filename', 'file_size', 'file_type');
})
$(document).on('click', '#profile', function () {
    selectFileWithCKFinderProfile('input_profile', 'file_upload_profile');
})
$(document).on('click', '#avatar', function () {
    selectFileWithCKFinderProfile('input_avatar_account', 'avatar');
})
$(document).on('click', '#library_file_upload', function () {
    selectFileWithCKFinderLibrary('file_path', 'file_name', 'file_size', 'file_type');
})
//Ck finder 
function selectFileWithCKFinderProject(elementId) {
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
//Ck finder Library
function selectFileWithCKFinderLibrary(elementId, nameFile, fileSize, fileType) {
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        language: 'en',
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                var output = document.getElementById(elementId);
                var name_file = document.getElementById(nameFile);
                var size = document.getElementById(fileSize);
                var type = document.getElementById(fileType);
                output.value = file.getUrl();
                name_file.value = file.get('name');
                size.value = file.get('size') + ' KB';
                type.value = getFileExtension(file.get('name'));
            });

            finder.on('file:choose:resizedImage', function (evt) {
                var output = document.getElementById(elementId);
                output.value = evt.data.resizedUrl;
            });
        }
    });
}
//Get type file library
function getFileExtension(filename) {
    return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
}
///
function selectFileWithCKFinder(elementId, filePath, nameFile, fileSize, fileType) {
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                var output = document.getElementById(elementId);
                var name_file = document.getElementById(nameFile);
                var size = document.getElementById(fileSize);
                var type = document.getElementById(fileType);
                var path = document.getElementById(filePath);
                output.value = file.getUrl();
                path.value = file.getUrl();
                name_file.value = file.get('name');
                size.value = file.get('size') + ' KB';
                type.value = getFileExtension(file.get('name'));
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

//ckfinder with profile
function selectFileWithCKFinderProfile(elementId, imgId) {
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                var output = document.getElementById(elementId);
                var img = document.getElementById(imgId);
                output.value = file.getUrl();
                img.src = file.getUrl();
            });

            finder.on('file:choose:resizedImage', function (evt) {
                var output = document.getElementById(elementId);
                output.value = evt.data.resizedUrl;
            });
        }
    });
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
            createSelectColumnStatus(input, approved, rejected, submitted);
        }
        input.setAttribute('placeholder', placeholder);
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}
//search column project
function searchColumsDataTableProjects(datatable) {
    datatable.api().columns([1, 2, 3, 4, 5, 6, 7]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 4) {
            input.setAttribute('type', 'date');
        } else if (column.selector.cols == 6) {
            input = document.createElement("select");
            createSelectColumnStatus(input, approved, rejected, submitted);
        } else if (column.selector.cols == 5) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">--' + all + '--</option>');
            column.data().unique().sort().each(function (d, j) {
                $(input).append('<option value=' + d + '>' + d + '</option>');
            });
        }
        input.setAttribute('placeholder', placeholder);
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}
//search column project report
function searchColumsDataTableProjectsReport(datatable) {
    datatable.api().columns([1, 4, 5, 6]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 4) {
            input.setAttribute('type', 'date');
        } else if (column.selector.cols == 6) {
            input = document.createElement("select");
            createSelectColumnStatus(input, approved, rejected, submitted);
        }
        input.setAttribute('placeholder', placeholder);
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}
//search column admin
function searchColumsDataTableAdmins(datatable) {
    datatable.api().columns([1, 2, 3, 4, 5, 6, 7, 9]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 9) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">--' + all + '--</option>');
            $(input).append('<option value="3">' + supper_admin + '</option>');
            $(input).append('<option value="2">' + admin_project + '</option>');
            $(input).append('<option value="1">' + employee + '</option>');
        }
        else if (column.selector.cols == 5) {
            input.setAttribute('type', 'date');
        } else if (column.selector.cols == 6) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">--' + all + '--</option>');
            $(input).append('<option value="0">' + male + '</option>');
            $(input).append('<option value="1">' + famale + '</option>');
        }
        input.setAttribute('placeholder', placeholder);
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}
//search column employee
function searchColumsDataTableEmployee(datatable) {
    datatable.api().columns([1, 4, 5, 6, 7]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 7) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">' + all + '</option>');
            $(input).append('<option value="0">' + male + '</option>');
            $(input).append('<option value="1">' + famale + '</option>');

        }
        else if (column.selector.cols == 6) {
            input.setAttribute('type', 'date');
        }
        input.setAttribute('placeholder', placeholder);
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}
//search column library
function searchColumsDataTableLibrary(datatable) {
    datatable.api().columns([1, 5, 7]).every(function () {
        var column = this;
        var input = document.createElement("input");
        input.setAttribute('class', 'form-control');
        if (column.selector.cols == 7) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">' + all + '</option>');
            $(input).append('<option value=0>' + approved + '</option>');
            $(input).append('<option value=1>' + not_approved + '</option>');
        } else if (column.selector.cols == 5) {
            input = document.createElement("select");
            input.setAttribute('class', 'form-select');
            $(input).append('<option value="">' + all + '</option>');
            column.data().unique().each(function (d, j) {
                $(input).append('<option value=' + d + '>' + d + '</option>');
            });
        }
        input.setAttribute('placeholder', placeholder);
        $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
    });
}

function appentTo() {
    $('#projects-table tfoot tr').appendTo('#projects-table thead');
    $('#projectreport-table tfoot tr').appendTo('#projectreport-table thead');
    $('#admins-table tfoot tr').appendTo('#admins-table thead');
    $('#library-table tfoot tr').appendTo('#library-table thead');
    $('#employee-table tfoot tr').appendTo('#employee-table thead');
}

function createSelectColumnStatus(input, value1, value2, value3) {
    input.setAttribute('class', 'form-select');
    $(input).append('<option value="">--' + all + '--</option>');
    $(input).append('<option value="0">' + value1 + '</option>');
    $(input).append('<option value="1">' + value2 + '</option>');
    $(input).append('<option value="2">' + value3 + '</option>');
}
function createSelectColumnUniqueDatatableAll(input, column) {
    input.setAttribute('class', 'form-select');
    $(input).append('<option value="">--' + all + '--</option>');
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
        placeholder: selectProject,
    });
    $('#employee_report').select2({
        placeholder: selectEmployee,
    });
    $('#admin').select2({
        placeholder: "Admin",
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
$(document).ready(function () {
    columns = window.LaravelDataTables["admins-table"].columns();
    toggleColumnsDatatable(columns);
});
$(document).ready(function () {
    columns = window.LaravelDataTables["library-table"].columns();
    toggleColumnsDatatable(columns);
});
$(document).ready(function () {
    columns = window.LaravelDataTables["employee-table"].columns();
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
        htmlToggleColumns += `<label class="dropdown-item"><input class="toggle-vis form-check-input m-0 me-2" ${checked} type="checkbox" data-column="${index}">${value}</label>`;
        $(".drop-toggle-columns").html(htmlToggleColumns);
    });
}
$(document).on('change', 'input.toggle-vis', function (e) {
    e.preventDefault();
    var column = columns.column($(this).attr('data-column'));
    column.visible(!column.visible());
});

//status library
$(document).on('change', 'input.checked_library_status', function (e) {
    if ($(this).is(":checked")) {
        $(this).val("0");
    } else {
        $(this).val("1");
    }
    var value_status = $(this).val();
    var library_id = $(this).attr('id');
    // console.log(user_id);
    $.ajax({
        type: "PUT",
        url: 'library-status/' + library_id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { status: value_status },
        cache: false,
        dataType: "json",
        success: function (response) {
            if (value_status == "1") {
                $.ajax({
                    type: "DELETE",
                    url: 'filedownload/destroy/' + library_id,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { id: library_id },
                    cache: false,
                    dataType: "json",
                    success: function (response) {
                    }
                });
            }
            if (value_status == "0") {
                $.ajax({
                    type: "POST",
                    url: 'file_download/store',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { id: library_id },
                    cache: false,
                    dataType: "json",
                    success: function (response) {
                    }
                });
            }
            if (response.status == 400)
                window.location.assign("404");
            else
                window.location.assign('library');
        }
    });

}); 