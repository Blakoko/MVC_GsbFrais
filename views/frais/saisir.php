
<div class="bg-info col-md-10" id="content" data-pg-collapsed>
    <div id="fraisforfait">
        <div class="row">
            <h3>Frais au forfait<br></h3>
            <form id="formff" action="" method="post">
                <div>
                    <div class="repeat1">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label" for="formInput20">Type
                                    </label>
                                    <select id="formInput20" class="form-control" name="type[]">
                                        <?php foreach ($this->getLestypes as $key => $value) : ?>
                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['libelle'] ?></option>
                                        <? endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label" for="formInput27">Quantité / Nombres</label>
                                <input type="text" class="form-control number-only" name="description[]">
                            </div>
                        </div>
                    </div>
                    <div id="repetition1">

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="control-label" for="formInput12">Ajouter</label>
                        <button type="button" class="btn btn-primary btn-sm repeatx" onclick="repet2()">+</button>
                    </div>
                </div>
                <div class="row" data-pg-hidden>
                    <div class="text-right col-md-12">
                        <button id="btn2" type="submit" class="btn btn-primary">Valider</button>
                        <!--FIN DIV hors FORFAIT-->
                    </div>
                    <!--fin-->
                </div>
            </form>
        </div>
    </div>
    <hr id="separateur1" />
    <div id="fichefrais">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <thead>
                        <h3>Au Forfait</h3><br>
                        <tr class="bg-primary">
                            <th>Repas Restaurants</th>
                            <th>Nuitée Hotel</th>
                            <th>Forfait Etape</th>
                            <th>Frais Kilometriques</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- FIn DIV Fiche FRais -->
    </div>
    <hr id="separateur2" />
    <div id="elementshorsforfait">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <h3>Hors Forfait</h3><br>
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
                            <td>00-00-0000</td>
                            <td>Seminaire</td>
                            <td>0.89€</td>
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
    </div>
    <div class="row">
        <form id="formhf" action="" method="post">
            <div class="repeat2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="formInput29">Date</label>
                        <input type="text" class="datepicker form-control" name="date_hf[]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="formInput25">Description &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        </label>
                        <input type="text" class="form-control" id="desc" name="libelle_hf[]">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="formInput7">Montant&nbsp;
                        </label>
                        <input type="text" class="form-control number-only" id="montant" name="montant[]">
                    </div>
                </div>
            </div>
            <div id="repetition"></div>
            <div class="col-md-1" data-pg-collapsed>
                <div class="form-group">
                    <label class="control-label" for="formInput12">Ajouter</label>
                    <button id="addhf" type="button" class="btn btn-primary btn-sm repeat" onclick="repet()">+</button>
                </div>
            </div>
            <div class="row">
                <div class="text-right col-md-12">
                    <button id="btn2" type="submit" class="btn btn-primary">Valider</button>
                    <!--FIN DIV hors FORFAIT-->
                </div>
                <!--fin-->
            </div>
        </form>
    </div>
</div>






<?php var_dump($_POST); ?>
<?php //var_dump($this->VeriFicheFrais);?>
<?php //var_dump($this->compter[0]['cont'])?>

<?php //print_r($_POST);?>
