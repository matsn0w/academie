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
            var mydata = "<?php echo $site; ?>/includes/leiding-vacature.php";

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
                colNames: ['#', 'Naam', 'Email', 'Datum'],
                colModel: [
                    {name: 'id', index: 'id', width: 60, sorttype: "int"},
                    {name: 'naam', index: 'naam', width: 60},
                    {name: 'vacature', index: 'vacature', width: 60},
                    {name: 'date', index: 'date', width: 60}
                ],
                onSelectRow: function(id, iRow, iCol, e) {
                    location.href="<?php echo $site; ?>/leiding/bekijk/vacature/"+id+" "
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
                    <h2>Vacature Beheer</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Home</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li class="active">
                            <strong>Vacature beheer</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                    if(isset($_POST['makeVacature'])){
                        $titel = $db->real_escape_string($_POST['titel']);
                        $uitleg = $db->real_escape_string($_POST['uitleg']);
                        
                        if(empty($titel)){
                            echo 'Je bent vergeten een titel in te vullen';
                        }elseif(empty($uitleg)){
                            echo 'Je bent vergeten een uitleg in te vullen';
                        }else{
                            $query = $db->query("INSERT INTO vacatures (titel,text,date) VALUES (
                            '".$titel."',
                            '".$uitleg."',
                            NOW()
                            )");
                            if($query){
                                echo 'Succesvol de vacature aangemaakt!';
                            }else{
                                echo 'Error bij het maken van de vacature';
                            }
                        }
                    }
                    ?>
                    
                    <div class="tabbable" id="tabs-649102">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#panel-529931" data-toggle="tab">Vacature Reacties</a>
                            </li>
                            <li>
                                <a href="#panel-941512" data-toggle="tab">Vacature Aanmaken</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="panel-529931">
                                <p>
                                    <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Vacature Beheer</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="jqGrid_wrapper">
                                        <table id="table_list_1"></table>
                                        <div id="pager_list_1"></div>
                                   </div>

                                </div>
                            </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="panel-941512">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Titel</label>
                                        <input type="text" name="titel" class="form-control" placeholder="Website Designer">
                                    </div>
                                    <div class="form-group">
                                        <label>Uitleg</label>
                                        <textarea name="uitleg" class="form-control" placeholder="Website Designer"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="makeVacature" value="Aanmaken" class="btn btn-primary">
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<?php } ?>