$(document).ready(function () {
    // меню
    $("#table-7").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/PositionMenu",
                data: {"menu[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });
    // школа
    $("#table-6").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/PositionEducation",
                data: {"position[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });
    // классы
    $("#table-5").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/PositionClassroom",
                data: {"position[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });
    // уроки
    $("#table-4").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/PositionLesson",
                data: {"position[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });

    // свойства
    $("#table-3").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/PositionProperties",
                data: {"position[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });

    // категории
    $("#table-2").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/PositionCategory",
                data: {"position[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });

    // страницы
    $("#table-1").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/PositionPages",
                data: {"position[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });

    // блоки на главной
    $("#table-mainBlocks").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            $('#blockLoader').show();
            var rows = table.tBodies[0].rows;
            var position = [];
            for (var i = 0; i < rows.length; i++) {
                position[i] = rows[i].id;
            }
            $.ajax({
                type: "POST",
                url: "/administration/adminCompany/editPositionMainBlocks",
                data: {"position[]": position},
                success: function (data) { //console.log(data);
                    $('#blockLoader').hide();
                    viewBlockSuccessPosition(data.success);
                },
                error: function (data)
                {
                    $('#blockLoader').hide();
                    viewBlockErrorPosition(data.success);
                }
            });
        }
    });
});
function viewBlockSuccessPosition(success) {
    $('#blockPosition').show();
    setTimeout(function () {
        $('#blockPosition').hide();
    }, 3000);
}
function viewBlockErrorPosition(success) {
    $('#blockError').show();
    setTimeout(function () {
        $('#blockError').hide();
    }, 3000);
}
