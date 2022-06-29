<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
?><!-- jqGrid -->
    <script src="<?php echo $site; ?>/js/plugins/jqGrid/i18n/grid.locale-en.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/jqGrid/jquery.jqGrid.min.js"></script>
    <link href="<?php echo $site; ?>/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">


<script>
        $(document).ready(function () {


            // Examle data for jqGrid
            var mydata = "<?php echo $site; ?>/includes/instructeur-agenda.php";

            // Configuration for jqGrid Example 1
            $("#table_list_1").jqGrid({
                url: mydata,
                datatype: "json",
                mtype: "GET",
                height: 250,
                autowidth: true,
                shrinkToFit: true,
                rowNum: 14,
                rowList: [10, 20, 30],
                colNames: ['#', 'Titel', 'Datum', 'Link'],
                colModel: [
                    {name: 'id', index: 'id', width: 10, sorttype: "int"},
                    {name: 'title', index: 'title', width: 60},
                    {name: 'start', index: 'start', width: 30},
                    {name: 'url', index: 'url', width: 60}
                ],
                onSelectRow: function(id, iRow, iCol, e) {
                    location.href="<?php echo $site; ?>/instructeur/bekijk/agenda/"+id+" "
                },
                pager: "#pager_list_1",
                viewrecords: true,
                hidegrid: false
            });

            // Add responsive to jqGrid
            $(window).bind('resize', function () {
                var width = $('.jqGrid_wrapper').width();
                $('#table_list_1').setGridWidth(width);
            });
        });

    </script>

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Agenda beheer</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Home</a>
                        </li>
                        <li>
                            <a>Instructeur</a>
                        </li>
                        <li class="active">
                            <strong>Agenda</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Agenda Beheren</h5>
                        </div>
                        <div class="ibox-content">
                            <span class="glyphicon glyphicon-edit"></span> <a href="<?php echo $site; ?>/instructeur/toevoegen/agenda">Item Toevoegen</a> 
                            <div class="jqGrid_wrapper">
                                <table id="table_list_1"></table>
                                <div id="pager_list_1"></div>
                           </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>