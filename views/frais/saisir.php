<div class="bg-info col-md-10" data-pg-collapsed>
    <div id="fraisforfait">
        <div class="row">
            <h3>Frais au forfait<br></h3>
            <div>
                <div class="col-md-1">
                    <h4>1:</h4>
                </div>
                <form action="" method="post">
                <div class="col-md-2">
                    <div class="form-group">

                            <div class="form-group">
                                <label class="control-label" for="formInput20">Type
                                    <br>
                                </label>
                                <select id="formInput20" class="form-control" name="type">
                                    <?php foreach ($this->getLestypes as $key => $value) : ?>
                                        <option
                                            value="<?php echo $value['id'] ?>"><?php echo $value['libelle'] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="formInput27">Description&nbsp;
                            <br>
                        </label>
                        <input type="text" class="form-control" name="description">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="formInput22">Debut &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                            <br>
                        </label>
                        <input type="text" class="form-control" id="datepicker" name="date_debut">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="formInput18">Fin</label>
                        <input type="text" class="form-control" name="date_fin" id="datepicker2">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="control-label" for="formInput12">Ajouter</label>
                        <button type="submit" class="btn btn-primary btn-sm">+</button>

                </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <hr id="separateur1"/>
    <div id="fichefrais">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <thead>
                        <h3>Fiches Frais<br><br></h3>
                        <tr class="bg-primary">
                            <th>Type
                                <br>
                            </th>
                            <th>Montant</th>
                            <th>Date Debut</th>
                            <th>Date Fin</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td class="text-uppercase bg-success text-center">Supprimer</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- FIn DIV Fiche FRais -->
    </div>
    <hr id="separateur2"/>
    <div id="elementshorsforfait">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <h3>Hors Forfait<br></h3>
                        <tr class="bg-primary">
                            <th>Date</th>
                            <th>Description</th>
                            <th>Montant
                                <br>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td class="text-center bg-success">SUPPRIMER</td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- FIN DIV hors forfait-->
                </div>
            </div>
        </div>
    </div>
    <hr id="separateur3">
    <div id="horsforfait">
        <div id="repeat">
            <div class="row" >
                <div class="col-md-1">
                    <h4>1:</h4>
                </div>
                <div class="col-md-3">

                    <div class="form-group">
                        <form action="" method="post">
                            <label class="control-label" for="formInput29">Date
                                <br>
                            </label>
                            <input type="text" class="form-control" id="date" name="date_hf">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="formInput25">Libellé&nbsp;
                            <br>
                        </label>
                        <input type="text" class="form-control" id="formInput25" name="libelle_hf">
                    </div>
                    <br/>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="formInput7">Montant&nbsp;
                            <br>
                        </label>
                        <input type="text" class="form-control" id="formInput7" name="montant">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="control-label" for="formInput12">Ajouter</label>
                        <button id="addhf" class="btn btn-primary btn-sm">+</button>
                    </div>
                </div>
            </div>
        </div>

        <ol>
        </ol>
        <div class="row">
            <div class="text-right">
                <button id="btn2" type="submit" class="btn btn-primary">Valider</button>
                </form>
                <!--FIN DIV hors FORFAIT-->
            </div>
            <!--fin-->
        </div>
    </div>
</div>

<?php var_dump($_POST); ?>


