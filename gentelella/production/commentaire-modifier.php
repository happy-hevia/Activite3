<?php include_once "admin-top.php"; ?>

<!-- page content -->
<div class="right_col" role="main" >
    <div class="" >
        <div class="page-title" >
            <div class="title_left" >
                <h3 >modifier</h3 >
            </div >

        </div >
        <div class="clearfix" ></div >
        <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                    <div class="x_title" >
                        <h2 >Modifier le commentaire 14</h2 >
                        <ul class="nav navbar-right panel_toolbox" >
                            <li ><a class="collapse-link" ><i class="fa fa-chevron-up" ></i ></a >
                            </li >
                        </ul >
                        <div class="clearfix" ></div >
                    </div >
                    <div class="x_content" >
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" >
                            <div class="form-group" >
                                <label class="col-xs-12" for="nom" >Article
                                    <span class="required" >*</span >
                                </label >
                                <div class="col-xs-12" >
                                    <input type="text" id="nom" required="required" class="form-control" value="Nom de l'article" disabled >
                                </div >
                            </div >
                            <div class="form-group" >
                                <label class="col-xs-12" for="nom" >Réponse au commentaire
                                    <span class="required" >*</span >
                                </label >
                                <div class="col-xs-12" >
                                    <input type="text" id="nom" required="required" class="form-control" value="aucun" disabled >
                                </div >
                            </div >
                            <div class="form-group" >
                                <label class="col-xs-12" for="nom" >Auteur
                                    <span class="required" >*</span >
                                </label >
                                <div class="col-xs-12" >
                                    <input type="text" id="nom" required="required" class="form-control" value="Auteur du commentaire" >
                                </div >
                            </div >
                            <div class="form-group" >
                                <label class="col-xs-12" for="contenu" >Contenu
                                    <span class="required" >*</span >
                                </label >
                                <div class="col-xs-12" >
                                    <input type="text" id="contenu" required="required" class="form-control" value="Contenu du commentaire" />
                                </div >
                            </div >
                            <div class="ln_solid" ></div >
                            <div class="form-group" >
                                <div class="col-md-6 col-sm-6 col-xs-12" >
                                    <button type="submit" class="btn btn-lg btn-success" >Modifier</button >
                                    <button type="button" class="btn btn-lg btn-danger" >Supprimer</button >
                                </div >
                            </div >

                        </form >
                    </div >
                </div >
            </div >
        </div >
    </div >
</div >

<?php include_once "admin-bottom.php"; ?>
