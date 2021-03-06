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
                        <h2 >Modifier l'article : nom de l'article</h2 >
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
                                <label class="col-xs-12" for="nom" >Titre
                                    <span class="required" >*</span >
                                </label >
                                <div class="col-xs-12" >
                                    <input type="text" id="nom" required="required" class="form-control" value="Titre de l'article" >
                                </div >
                            </div >
                            <div class="form-group" >
                                <label class="col-xs-12" for="contenu" >Contenu
                                    <span class="required" >*</span >
                                </label >
                                <div class="col-xs-12" >
                                    <textarea id="contenu" required="required" class="form-control" >Contenu de l'article</textarea >
                                </div >
                            </div >
                            <div class="checkbox" >
                                <label class="" >
                                    <div class="icheckbox_flat-green checked" style="position: relative;" >
                                        <input type="checkbox" class="flat" checked="checked" style="position: absolute; opacity: 0;" >
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" ></ins >
                                    </div >
                                    Publier maintenant
                                </label >
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
