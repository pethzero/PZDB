<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    if (!isset($_SESSION["RECNO"])) {
        header("Location: index.php"); // ตัวอย่างการเด้งไปยังหน้า login.php
        exit(); // ออกจากสคริปต์เพื่อหยุดการทำงานต่อ
    }
    include("0_headcss.php");
    ?>
    <link rel="preload" href="css/loader.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
</head>
<?php
$data_link = "";
$data_message = "";
$size = count($_GET);
$recno = null;
?>

<body>
    <?php
    include("0_header.php");
    ?>
    <link rel="stylesheet" href="css/mycustomize.css">
    <style>
        .c_activity {
            width: 100px;
        }

        .h_textarea {
            height: 110px;
        }

        textarea {
            /* overflow-x: scroll; */
            white-space: nowrap;
            /* overflow-y: scroll; */
        }

        .datepicker td,
        th {
            text-align: center;
            padding: 8px 12px;
            font-size: 14px;
        }

        .datepicker {
            border: 1px solid black;
        }

        /* #detailtable th.no-wrap {
            white-space: normal;
            width: auto;
        } */


        /* th.detail-tr {
            width: 3000px;
        } */

        @media (min-width: 768px) {
            .custom-input-pc {
                width: 450px;
            }

            .btn-input {
                width: 120px;
            }

            /* .company-input {
                width: 400px;
            }
            .detail-input {
                width: 500px;
            } */
            /* .remark-input {
                width: 200px;
            } */

            /* .detail-input {
                width: 700px;
            }
            .remark-input {
                width: 500px;
            } */

            /* th.detail-tr {
                width: 10000px;
            }

            th.date-tr {
                width: 10000px;
            } */


            .date-input {
                width: 140px;
            }


        }

        @media (max-width: 767px) {
            .custom-input-phone {
                width: 300px;
            }

            /* th.detail-tr {
                width: 3000px !important;
            } */

            .company-input {
                width: 250px;
            }

            .detail-input {
                width: 300px;
            }

            .remark-input {
                width: 200px;
            }

            /*
            tr th.date-input {
                width: 200px !important;
            } */
            .date-input {
                width: 120px;
            }
        }
    </style>

    <form id="idForm" method="POST">
        <section>
            <div class="container-fluid">
                <div class="row pt-3">
                    <h2>ตารางนัดหมาย</h2>
                </div>
                <hr>
                <div class="createdata">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <button id="addtable" type="button" class="btn-input btn btn-primary me-3">เพิ่ม</button>
                                <button id="canceltable" type="button" class="btn-input  btn btn-danger">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-sm-6 col-md-4 col-lg-2">
                            <button type="submit" id="save" name='save' value="save" class="btn-input btn btn-primary float-right float-end">save</button>
                        </div>
                    </div>
                    <div class="row pt-2 table-responsive">
                        <table id="createtable" class="nowrap table table-striped table-bordered" width='100%'>
                            <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>ชื่อลูกค้า</th>
                                    <th>รายละเอียด</th>
                                    <th>หมายเหตุ</th>
                                    <th>วันที่นัด</th>
                                    <th>ระบบเแจ้ง</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row pt-2 table-responsive">
                    <table id="detailtable" class="nowrap table table-striped table-bordered" width='100%'>
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>ข้อมูล</th>
                                <th>ชื่อลูกค้า</th>
                                <th>รายละเอียด</th>
                                <th>หมายเหตุ</th>
                                <th>วันที่นัด</th>
                                <th>ระบบเแจ้ง</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </form>
    <hr>
    <footer class="text-center mt-auto">
        <div class="container pt-2">
            <div class="row">
                <div class="col-12">
                    <p>Copyright ? SAN Co.,Ltd. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- <div class="loading" ></div> -->
</body>
<?php include("0_footerjs.php"); ?>


<script>
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13 && !$(event.target).is('textarea')) {
                event.preventDefault();
                return false;
            }
        });
        var userlevel = "<?php echo isset($_SESSION['USERLEVEL']) ? $_SESSION['USERLEVEL'] : ''; ?>";
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        const formatDate = (data) => {
            if (!data || data === '0000-00-00') {
                return '00/00/0000'; // ถ้าค่าว่างหรือไม่ถูกต้อง ส่งค่าว่างกลับไป
            }
            const dateObj = new Date(data);
            const day = dateObj.getDate();
            const month = dateObj.getMonth() + 1;
            const year = dateObj.getFullYear();
            const formattedDate = `${(day < 10 ? '0' + day : day)}/${(month < 10 ? '0' + month : month)}/${year}`;
            return formattedDate;
        };
        const customButtonEdit = (data, type, row, istatus) => {
            let divele = "";
            if (data['STATUS'] == "F") {
                if (istatus == "S") {
                    divele = `<button class="btn btn-warning btn-sm edit-row"><i class="far fa-edit"></i></button>`;
                } else {
                    divele = `<button class="btn btn-primary btn-sm view"><i class="far fa-eye"></i></button>`;
                }
            } else {
                divele = `<button type="button" class="btn btn-warning btn-sm edit-row" ><i class="far fa-edit"></i></button>`;
            }
            return divele;
        };

        const customButtonRemove = (data, type, row, istatus) => {
            let divele = "";
            // if (data['STATUS'] == "F") {
            //     if (istatus == "S") {
            //         divele = `<button class="btn btn-danger btn-sm removerow"><i class="fa fa-trash"></i></button>`;
            //     } else {
            //         divele = `<button class="btn btn-primary btn-sm view"><i class="far fa-eye"></i></button>`;
            //     }
            // } else {
            //     divele = `<button type="sumbit" class="btn btn-danger btn-sm removerow" ><i class="fa fa-trash"></i></button>`;
            // }
            divele = `<button   type="submit" id="removerow" name='removerow' value="removerow"  class="btn btn-danger btn-sm removerow" ><i class="fa fa-trash"></i></button>`;
            return divele;
        };
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        var createtable = $('#createtable').DataTable({
            "paging": false,
            "info": false,
            "searching": false,
            "ordering": false,
            // "scrollX": true,
            // order: [],
            "columnDefs": [{
                    "width": "3%",
                    "targets": [0, 6]
                },
                {
                    "width": "8%",
                    "targets": [4, 5]
                },
                {
                    "width": "12%",
                    "targets": [3]
                },
            ],
            // rowCallback: function(row, data) {},
        });

        var selectedRow = null;
        var detailtable = $('#detailtable').DataTable({
            // "paging": false,
            "info": false,
            // "searching": false,
            // "ordering": false,
            // scrollX: true,
            order: [],
            columns: [{
                    data: 'RECNO'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return customButtonEdit(data, type, row, userlevel);
                    }
                },
                {
                    data: 'CUSTNAME'
                },
                // {
                //     data: 'CONTNAME'
                // },
                {
                    data: 'DETAIL',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            return data.replace(/\n/g, '<br>');
                        }
                        return data;
                    }
                },
                {
                    data: 'REMARK'
                },
                {
                    data: 'STARTD',
                    render: formatDate
                },
                {
                    data: 'WARND',
                    render: formatDate
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return customButtonRemove(data, type, row, userlevel);
                    }
                },
            ],
            "columnDefs": [{
                    "width": "6%",
                    "targets": [1]
                },
                {
                    "width": "8%",
                    "targets": [5, 6]
                },
                {
                    "width": "12%",
                    "targets": [4]
                },
                {
                    "width": "3%",
                    "targets": [7]
                },
                {
                    "orderable": false,
                    "targets": [1]
                },
                {
                    "visible": false,
                    "targets": [0]
                },
                {
                    type: 'th_date',
                    targets: [5, 6]
                }
            ],
            rowCallback: function(row, data) {

            },
        });


        // สร้างฟังก์ชันสำหรับดึงข้อมูลจากแหล่งข้อมูล
        function getDataFromServer() {
            // กำหนด URL ของแหล่งข้อมูลที่ต้องการดึงข้อมูลฃ
            fetch('ajax/process_select.php', {
                    method: 'POST',
                    body: set_formdata('select'), // ใช้ FormData เป็นข้อมูลที่จะส่ง
                })
                .then((response) => {
                    // ทำงานเมื่อรับการตอบกลับจากเซิร์ฟเวอร์
                    if (response.ok) {
                        return response.json(); // แปลงข้อมูล JSON จากการตอบกลับ
                    } else {
                        throw new Error('เกิดข้อผิดพลาดในการส่งข้อมูล');
                    }
                })
                .then((data) => {
                    // ทำอะไรกับข้อมูลที่ได้รับหลังจาก POST สำเร็จ
                    console.log(data)
                    detailtable.clear().rows.add(data.datasql).draw();
                })
                .catch((error) => {
                    // จัดการข้อผิดพลาด
                    console.error(error);
                });
        }
        // เรียกใช้งานฟังก์ชัน getDataFromServer เพื่อดึงข้อมูลเมื่อคุณต้องการ
        getDataFromServer();
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        var counter = 0;
        const TableAdd = () => {
            counter++;
            const newRow = createtable.row.add([
                counter,
                `<input type="text" class="company-input form-control " maxlength="250" required/>`,
                ` <textarea class="form-control detail-input" maxlength="500"  rows="2" ></textarea>`,
                ` <textarea class="form-control remark-input" maxlength="500" rows="2" ></textarea>`,
                `<div class="date datepicker_get" >
                    <input type="text" class="form-control date-input"/>
                    <span class="input-group-append">D_
                    </span>
                </div>`,
                `<div class="date  datepicker_get" >
                    <input type="text" class="form-control date-input" />
                    <span class="input-group-append">
                    </span>
                </div>`,
                `<button type="button" class="btn btn-danger delete-row ">ลบ</button>`
            ]).draw(false).node();
            $(newRow).attr('id', `row${counter}`); //tr
            $(newRow).find('.datepicker_get').datepicker({
                format: "dd/mm/yyyy",
                clearBtn: true,
                todayHighlight: true,
                autoclose: true
            });
        };
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('#createtable').on('click', '.delete-row', function() {
            counter--;
            createtable.row($(this).closest('tr')).remove().draw();
            createtable.column(0).nodes().each(function(cell, i) {
                var cellData = createtable.cell(cell).data();
                createtable.cell(cell).data(i + 1).draw();
            });
        });

        function set_formdata(conditionsformdata) {
            var formData = new FormData();
            formData.append('name', $('#name').val());
            /// upload ///
            formData.append('fileToUpload', '');
            $uploadolddb = '';
            /////////////
            var dateValue = $('#date').val();
            /// id ,param ///
            paramhd = {};
            // var paramhd = null;
            // เพิ่มอาร์เรย์ paramhd เข้าไปใน FormData และแปลงเป็น JSON ก่อน
            if (conditionsformdata == "save") {
                formData.append('queryIdHD', 'IND_APPPOINTMENT');
                formData.append('condition', '001');
            } else if (conditionsformdata == "delete") {
                formData.append('queryIdHD', 'DLT_APPPOINTMENT');
                formData.append('condition', 'DT000');
            } else if (conditionsformdata == "update") {
                formData.append('queryIdHD', 'UPD_APPPOINTMENT');
                formData.append('condition', '002');
            } else if (conditionsformdata == "modified") {
                formData.append('queryIdHD', 'MOUPD_DRAWING');
                formData.append('modifyIdHD', 'IND_DRAWING');
                formData.append('condition', 'I_DRAW');
            } else if (conditionsformdata == "select") {
                formData.append('queryIdHD', 'SELECT_APPPOINTMENT');
                formData.append('condition', '001');
            } else {
                // กรณีอื่น ๆ
                // other
            }

            formData.append('tableData', JSON.stringify(tableData));
            formData.append('DataEdit', JSON.stringify(DataEdit));
            formData.append('DataRemove', JSON.stringify(DataRemove));
            formData.append('paramhd', JSON.stringify(paramhd));
            ////////////////
            return formData;
        }

        $('#canceltable').on('click', function() {
            if (counter > 0) {
                clearTable(); // เรียกใช้ฟังก์ชันเพื่อล้างข้อมูล
            }
        });

        $('#createdata').on('click', function() {
            $('#createdata').hide();
            $('.createdata').show();
            TableAdd()
        });



        const clearTable = () => {
            createtable.clear().draw();
            counter = 0; // รีเซ็ตค่า counter
        };

        // สร้างฟังก์ชันเพื่อลบแถวสุดท้าย
        const deleteLastRow = () => {
            const rowCount = createtable.rows().count();
            if (rowCount > 0) {
                createtable.row(rowCount - 1).remove().draw();
                counter--;
            }
        };


        $('#idForm').on('submit', function(e) {
            e.preventDefault(); // ป้องกันการส่ง form ไปยังหน้าอื่น
            // ตรวจสอบว่าปุ่มที่ถูกคลิกคือ "save" หรือ "edit"
            // var saveButton = $('#save');
            // var editButton = $('#edit');
            let url = "";
            let status_sql = "";
            console.log(e.originalEvent.submitter)

            var clickedButtonName = e.originalEvent.submitter.name;

            if (clickedButtonName === 'save') {
                let url = 'ajax/process_insert.php';
                let status_sql = 'save';
                datatable_generetor();
                if (process == 'T') {
                    AlertSave(url, status_sql)
                }
            } else if (clickedButtonName === 'editsave') {
                // saveRemoveButton() 
                let url = 'ajax/process_update.php';
                let status_sql = 'update';
                AlertSave(url, status_sql)
            } else if (clickedButtonName === 'removerow') {
                // saveRemoveButton() 
                let url = 'ajax/process_delete.php';
                let status_sql = 'delete';
                AlertSave(url, status_sql)
                console.log('remove')
            }
        });
        $('#addtable').click(function() {
            TableAdd()
        });
        var process = 'F';
        var tableData = [];

        function datatable_generetor() {
            tableData = [];
            process = 'T';
            if (createtable.rows().count() > 0) {
                $('#createtable tbody tr').each(function() {
                    let companyValue = $(this).find('td:eq(1) .company-input').val();
                    let detailValue = $(this).find('td:eq(2) .detail-input').val(); // คอลัมน์ที่ 2
                    let remarkValue = $(this).find('td:eq(3) .remark-input').val(); // คอลัมน์ที่ 3
                    let dateActValue = $(this).find('td:eq(4) .date-input').val(); // คอลัมน์ที่ 4
                    let dateWarnValue = $(this).find('td:eq(5) .date-input').val(); // คอลัมน์ที่ 5

                    tableData.push({
                        name: companyValue,
                        detail: detailValue,
                        remark: remarkValue,
                        dateAct: dateActValue ? moment(dateActValue, 'DD/MM/YYYY').format('YYYY-MM-DD') : '0000-00-00',
                        dateWarn: dateWarnValue ? moment(dateWarnValue, 'DD/MM/YYYY').format('YYYY-MM-DD') : '0000-00-00',
                    });


                    let statusValue = $(this).find('td:eq(4)').text();
                    if (statusValue.trim() === 'T') {
                        process = 'F';
                    }
                });
            } else {
                process = 'F'
                tableData = [];
                Swal.fire({
                    title: 'ตารางว่าง',
                    html: '<img src="doc/nopermission.jpg"  width="150" height="150"  alt="รูปภาพ"><br><br><h4>แกไม่มีสิทธ์บันทึกข้อมูล</h4>',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                console.log('ตารางว่าง');
            }
        }
        //////////////////////////////////////////////////////////// CRUDSQL ////////////////////////////////////////////////////////////
        const CRUDSQL = (url, status_sql) => {
            const apiUrl = url;
            fetch(apiUrl, {
                    method: 'POST',
                    body: set_formdata(status_sql), // ใช้ FormData เป็นข้อมูลที่จะส่ง
                })
                .then((response) => {
                    // ทำงานเมื่อรับการตอบกลับจากเซิร์ฟเวอร์
                    if (response.ok) {
                        return response.json(); // แปลงข้อมูล JSON จากการตอบกลับ
                    } else {
                        throw new Error('เกิดข้อผิดพลาดในการส่งข้อมูล');
                    }
                })
                .then((data) => {
                    // ทำอะไรกับข้อมูลที่ได้รับหลังจาก POST สำเร็จ
                    console.log(data)
                    if (status_sql == 'save') {
                        clearTable();
                        getDataFromServer();
                    } else if (status_sql == 'update') {
                        clearTable();
                        saveRemoveButton();
                    } else if (status_sql == 'delete') {
                        clearTable();
                        RemoveRowTable()
                    }
                })
                .catch((error) => {
                    // จัดการข้อผิดพลาด
                    console.error(error);
                });
        };
        var message_alert = "คุณจะเปลี่ยนกลับไม่ได้!";
        //////////////////////////////////////////////////////////// AlertSave ////////////////////////////////////////////////////////////
        function AlertSave(url, status_sql) {
            Swal.fire({
                title: 'คุณแน่ใจแล้วใช่ไหม',
                text: message_alert,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ตกลงบันทึก',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                customClass: {
                    confirmButton: 'ok',
                    cancelButton: 'cancel'
                },
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    CRUDSQL(url, status_sql);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Swal.fire(
                        'ยกเลิก',
                        'ยังไม่มีการบันทึก',
                        'error'
                    )
                }
            })
        }
        //////////////////////////////////////////////////////////// CLICK ////////////////////////////////////////////////////////////
        var DataEdit = [];
        $('#detailtable').on('click', '.edit-row', function() {
            let row = $(this).closest('tr');
            let companyCell = row.find('td:eq(1)');
            let detailCell = row.find('td:eq(2)');
            let remarkCell = row.find('td:eq(3)');
            let dateActCell = row.find('td:eq(4)');
            let dateWarnCell = row.find('td:eq(5)');
            let companyValue = companyCell.text();
            let detailValue = detailCell.html(); // เราใช้ .html() เพื่อรับ HTML แบบที่มี <br>
            let remarkValue = remarkCell.html(); // เราใช้ .html() เพื่อรับ HTML แบบที่มี <br>
            let dateActValue = dateActCell.text() === "00/00/0000" ? '' : dateActCell.text();
            let dateWarnValue = dateWarnCell.text() === "00/00/0000" ? '' : dateWarnCell.text();
            // เปลี่ยน <br> เป็น \n
            detailValue = detailValue.replace(/<br>/g, "\n");
            remarkValue = remarkValue.replace(/<br>/g, "\n");
            // สร้าง input && textarea สำหรับแก้ไขข้อมูล
            let companyInput = '<input type="text" class="company-input form-control" value="' + companyValue + '" />';
            let detailTextarea = '<textarea class="form-control detail-input" maxlength="500" >' + detailValue + '</textarea>';
            let remarkTextarea = '<textarea class="form-control remark-input" maxlength="500" >' + remarkValue + '</textarea>';
            let dateActInput = `<div class="date datepicker_get" >
                    <input type="text" class="form-control date-input"  value="${dateActValue}"  />
                    <span class="input-group-append">
                    </span>
                </div>`;
            let dateWarnInput = `<div class="date datepicker_get" >
                    <input type="text" class="form-control date-input"  value="${dateWarnValue}"  />
                    <span class="input-group-append">
                    </span>
                </div>`;
            // คำนวณความยาวของข้อความที่แสดงผล
            let detailTextLines = detailValue.split(/\n/).length;
            let remarkTextLines = remarkValue.split(/\n/).length;
            // กำหนดความยาวของ textarea ให้เท่ากับจำนวนบรรทัดของข้อความ
            detailTextarea = $(detailTextarea).attr('rows', detailTextLines);
            remarkTextarea = $(remarkTextarea).attr('rows', remarkTextLines);
            // แทนที่ข้อมูลใน cell ด้วย textarea
            companyCell.html(companyInput);
            detailCell.html(detailTextarea);
            remarkCell.html(remarkTextarea);
            dateActCell.html(dateActInput);
            dateWarnCell.html(dateWarnInput);
            // ทำลายปุ่ม "แก้ไข"
            row.find('.edit-row').remove();
            // สร้างปุ่ม "บันทึก" และ "ยกเลิก"
            var saveButton = '<button type="sumbit" name="editsave" class="btn btn-success btn-sm save-row me-2"><i class="fa-solid fa-check"></i></button>';
            var cancelButton = '<button type="button" class="btn btn-danger btn-sm cancel-edit"><i class="fa-solid fa-x"></i></button>';
            row.find('td:eq(0)').html(saveButton + ' ' + cancelButton);
            $(row).find('.datepicker_get').datepicker({
                format: "dd/mm/yyyy",
                clearBtn: true,
                todayHighlight: true,
                autoclose: true
            });
        });


        $('#detailtable').on('click', '.cancel-edit', function() {
            let row = $(this).closest('tr');
            let companyValue = row.find('td:eq(1) .company-input').val();
            let detailValue = row.find('td:eq(2) .detail-input').val(); // คอลัมน์ที่ 2
            let remarkValue = row.find('td:eq(3) .remark-input').val(); // คอลัมน์ที่ 3
            let dateActValue = row.find('td:eq(4) .date-input').val(); // คอลัมน์ที่ 4
            let dateWarnValue = row.find('td:eq(5) .date-input').val(); // คอลัมน์ที่ 5
            // detailValue.replace(/<br>/g, "\n");
            // console.log(detailValue)
            detailValue = detailValue.replace(/\n/g, '<br>');
            row.find('td:eq(1)').html(companyValue);
            row.find('td:eq(2)').html(detailValue);
            row.find('td:eq(3)').html(remarkValue);
            row.find('td:eq(4)').html(dateActValue ? moment(dateActValue, 'DD/MM/YYYY').format('DD/MM/YYYY') : '00/00/0000');
            row.find('td:eq(5)').html(dateWarnValue ? moment(dateWarnValue, 'DD/MM/YYYY').format('DD/MM/YYYY') : '00/00/0000');
            // ทำลายปุ่ม "บันทึก" และ "ยกเลิก"
            row.find('.save-row .cancel-edit').remove();
            // สร้างปุ่ม "แก้ไข" 
            let editButton = '<button type="button" class="btn btn-warning btn-sm edit-row" ><i class="far fa-edit"></i></button>'
            row.find('td:eq(0)').html(editButton);
        });

        var select_tr = null;
        $('#detailtable').on('click', '.save-row', function() {
            DataEdit = [];
            let row = $(this).closest('tr');
            let rowData = $('#detailtable').DataTable().row($(this).closest('tr')).data();
            console.log(rowData.RECNO)
            // console.log(row)
            select_tr = row
            let companyValue = row.find('td:eq(1) .company-input').val();
            let detailValue = row.find('td:eq(2) .detail-input').val(); // คอลัมน์ที่ 2
            let remarkValue = row.find('td:eq(3) .remark-input').val(); // คอลัมน์ที่ 3
            let dateActValue = row.find('td:eq(4) .date-input').val(); // คอลัมน์ที่ 4
            let dateWarnValue = row.find('td:eq(5) .date-input').val(); // คอลัมน์ที่ 5
            DataEdit.push({
                recno: rowData.RECNO,
                name: companyValue,
                detail: detailValue,
                remark: remarkValue,
                dateAct: dateActValue ? moment(dateActValue, 'DD/MM/YYYY').format('YYYY-MM-DD') : '0000-00-00',
                dateWarn: dateWarnValue ? moment(dateWarnValue, 'DD/MM/YYYY').format('YYYY-MM-DD') : '0000-00-00',
            });
        });

        var DataRemove
        $('#detailtable').on('click', '.removerow', function() {
            DataRemove = [];
            let row = $(this).closest('tr');
            let rowData = $('#detailtable').DataTable().row($(this).closest('tr')).data();
            console.log(rowData.RECNO)
            // console.log(row)
            select_tr = row
            DataRemove.push({
                recno: rowData.RECNO,
            });
            // RemoveRowTable()
        });


        // แปลงและแสดงผลข้อมูลในคอลัมน์วันที่นัด
        function saveRemoveButton() {
            DataEdit[0].detail = DataEdit[0].detail.replace(/\n/g, '<br>')
            select_tr.find('td:eq(1)').html(DataEdit[0].name);
            select_tr.find('td:eq(2)').html(DataEdit[0].detail);
            select_tr.find('td:eq(3)').html(DataEdit[0].remark);
            if (DataEdit[0].dateAct === '0000-00-00') {
                select_tr.find('td:eq(4)').html('00/00/0000');
            } else {
                select_tr.find('td:eq(4)').html(moment(DataEdit[0].dateAct, 'YYYY-MM-DD').format('DD/MM/YYYY'));
            }
            if (DataEdit[0].dateWarn === '0000-00-00') {
                select_tr.find('td:eq(5)').html('00/00/0000');
            } else {
                select_tr.find('td:eq(5)').html(moment(DataEdit[0].dateWarn, 'YYYY-MM-DD').format('DD/MM/YYYY'));
            }
            select_tr.find('.save-row .cancel-edit').remove();
            // สร้างปุ่ม "แก้ไข" 
            let editButton = '<button type="button" class="btn btn-warning btn-sm edit-row" ><i class="far fa-edit"></i></button>'
            select_tr.find('td:eq(0)').html(editButton);
        }

        function RemoveRowTable() {
            // let row = $(this).closest('tr');
            $('#detailtable').DataTable().row(select_tr).remove().draw();
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
    });
</script>

</html>