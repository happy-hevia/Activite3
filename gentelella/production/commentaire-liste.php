<?php include_once "admin-top.php"; ?>

<!-- iCheck -->
<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet" >
<!-- Datatables -->
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" >
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" >
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet" >
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet" >
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet" >

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Articles</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Liste des articles</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                            Voici la liste complète des articles présents sur le site (publié ou non) :
                        </p>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th >ID</th>
                                <th>Auteur</th>
                                <th>Contenu</th>
                                <th>Article</th>
                                <th>Date</th>
                                <th>Action</th>
                                <th>Signalé</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="odd" >
                                <td tabindex="0" class="sorting_1" > 1</td >
                                <td>Nixon</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur dicta distinctio dolor, eum harum impedit laudantium minima nisi numquam odit officia praesentium quas qui quia sunt ullam voluptate voluptatem? Ad animi asperiores autem, consequuntur dolorum error incidunt laborum modi mollitia officiis placeat porro quae, quaerat quas qui quibusdam saepe sint sunt! Ad architecto aut deleniti dolorem, expedita magni quibusdam vero? Ad architecto aspernatur autem consectetur, culpa cum dignissimos dolore dolorem dolorum eaque error esse eum ex explicabo facere fugit illum in labore magnam modi molestias mollitia nesciunt nobis odit pariatur perspiciatis quasi quisquam repellendus rerum temporibus totam ut voluptatibus.</td>
                                <td>Nom de l'article</td>
                                <td>16/08/17 - 18h44</td>
                                <td><button class="btn btn-sm btn-primary">Modifier</button><button class="btn btn-sm btn-danger">Supprimer</button></td>
                                <td><span class="fa fa-check green"></span></td>
                            </tr>
                            <tr role="row" class="even" >
                                <td tabindex="0" class="sorting_1" > 2</td >
                                <td>Bartien</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur dicta distinctio dolor, eum harum impedit laudantium minima nisi numquam odit officia praesentium quas qui quia sunt ullam voluptate voluptatem? Ad animi asperiores autem, consequuntur dolorum error incidunt laborum modi mollitia officiis placeat porro quae, quaerat quas qui quibusdam saepe sint sunt! Ad architecto aut deleniti dolorem, expedita magni quibusdam vero? Ad architecto aspernatur autem consectetur, culpa cum dignissimos dolore dolorem dolorum eaque error esse eum ex explicabo facere fugit illum in labore magnam modi molestias mollitia nesciunt nobis odit pariatur perspiciatis quasi quisquam repellendus rerum temporibus totam ut voluptatibus.</td>
                                <td>Nom de l'article</td>
                                <td>16/08/17 - 18h44</td>
                                <td><button class="btn btn-sm btn-primary">Modifier</button><button class="btn btn-sm btn-danger">Supprimer</button></td>
                                <td><span class="fa fa-bell red"></span></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- footer content -->
<footer >
    <div class="pull-right" >
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com" >Colorlib</a >
    </div >
    <div class="clearfix" ></div >
</footer >
<!-- /footer content -->


<!-- Modal de confirmation -->
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header" >
                Confirmation de la suppression
            </div >
            <div class="modal-body" >
                Êtes vous sur de vouloir supprimer l'article "<span id="modal-confirmation__titre" ></span >" ?

            </div >

            <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" >Annuler</button >
                <a href="#" id="modal-confirmation__supprimer" class="btn btn-danger" >Supprimer</a >
            </div >
        </div >
    </div >


</div >
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js" ></script >
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js" ></script >
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js" ></script >
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js" ></script >
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js" ></script >
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js" ></script >
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js" ></script >
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js" ></script >
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js" ></script >
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js" ></script >
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js" ></script >
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" ></script >
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js" ></script >
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js" ></script >
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js" ></script >
<script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js" ></script >
<script src="../vendors/jszip/dist/jszip.min.js" ></script >
<script src="../vendors/pdfmake/build/pdfmake.min.js" ></script >
<script src="../vendors/pdfmake/build/vfs_fonts.js" ></script >

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js" ></script >

<!-- Datatables -->
<script>
    $(document).ready(function() {
        $('#datatable-responsive').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/French.json"
            }
        });
    });
</script>
<!-- /Datatables -->
</body>
</html>

