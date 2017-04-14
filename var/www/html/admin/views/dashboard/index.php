
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Member</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                   <?php  

                                    if (isset($this->data) && !empty($this->data)) {
                                        echo $this->data;
                                    }
                                   ?>
                                   
                                </div>
                                <div class="text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.row -->

             

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <style type="text/css">
    #page-wrapper {
        height: 100%;
        padding: 20px;
        min-height: 700px;
    }
    table tr td{
        min-width: 100px;
    }
</style>
