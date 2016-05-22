<div class="bg-info col-md-10" id="content" data-pg-collapsed>
    <div id="fraisforfait">
        <div class="row">
            <h3>Frais au forfait</h3>
            <div id="atk" class=""></div>
            <form id="formff" action="valfraisforfaits" method="post">
                <div>
                    <div class="repeat1">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label" for="formInput20">Type
                                    </label>
                                    <select id="formInput20" class="type form-control" name="type[]">
                                        <?php foreach ($this->getLestypes as $key => $value) : ?>
                                            <option
                                                value="<?php echo $value['id'] ?>"><?php echo $value['libelle'] ?></option>
                                        <? endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label" for="formInput27">Quantité - Nombres</label>
                                <input type="text" class="quantite form-control number-only" name="quantite[]">
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
                        <button id="btn1" type="submit" class="btn btn-primary">Valider</button>
                        <!--FIN DIV hors FORFAIT-->
                    </div>
                    <!--fin-->
                </div>
            </form>
        </div>
    </div>
    <hr id="separateur1"/>
    <?php if (empty($this->LesFraisForfait)): ?>
        <h3>Pas De Frais Au Forfait</h3>
    <?php else : ?>
        <div id="fichefrais">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                            <h3>Au Forfait</h3><br>
                            <tr class="bg-primary">
                                <th>Repas Midi</th>
                                <th>Nuitée Hotel</th>
                                <th>Forfait Etape</th>
                                <th>Frais Kilometriques</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <form action="" method="post">
                                    <td><input value="<?php echo $this->LesFraisForfait[3]['quantite'] ?>" type="text"
                                               class="form-control number-only" id="montant" name="ff_repas"></td>
                                    <td><input value="<?php echo $this->LesFraisForfait[1]['quantite'] ?>" type="text"
                                               class="form-control number-only" id="montant" name="ff_hotel"></td>
                                    <td><input value="<?php echo $this->LesFraisForfait[2]['quantite'] ?>" type="text"
                                               class="form-control number-only" id="montant" name="ff_etape"></td>
                                    <td><input value="<?php echo $this->LesFraisForfait[0]['quantite'] ?>" type="text"
                                               class="form-control number-only" id="montant" name="ff_km"></td>
                                    <td>
                                        <button id="btn2" type="submit" class="btn btn-primary btn-block">mettre a
                                            jour
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- FIn DIV Fiche FRais -->
        </div>
    <?php endif; ?>
    <hr id="separateur2"/>
    <?php if (empty($this->LesFraisHorsForfait)): ?>
        <h3>Pas de Frais Hors Forfaits Enregistré</h3>
    <?php else : ?>
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
                            <?php foreach ($this->LesFraisHorsForfait as $key => $val): ?>
                                <tr>
                                    <td><?php echo $val['date'] ?></td>
                                    <td><?php echo $val['libelle'] ?></td>
                                    <td><?php echo $val['montant'] ?></td>
                                    <td class="text-center bg-success"><a href="delete/<?php echo $val['id'] ?>" class="delete">SUPPRIMER</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                            </tbody>
                        </table>
                        <!-- FIN DIV hors forfait-->
                    </div>
                </div>
            </div>
        </div>
        <hr id="separateur3">
    <?php endif; ?>
    <div id="ack" class="">
    </div>
    <div id="horsforfait">
    </div>
    <div class="row">
        <form id="myform" action="valfraishorforfaits" method="post">
            <div class="repeat2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="formInput29">Date</label>
                        <input type="text" class="datepicker form-control" name="date_hf[]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="formInput25">Description &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        </label>
                        <input type="text" class="desc form-control" name="libelle_hf[]">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="formInput7">Montant&nbsp;
                        </label>
                        <input type="text" class="montant form-control number-only" name="montant[]">
                    </div>
                </div>
            </div>
            <div id="repetition"></div>
            <div class="col-md-1" data-pg-collapsed>
                <div class="form-group">
                    <label class="control-label" for="formInput12">Ajouter</label>
                    <button id="submit" type="button" class="btn btn-primary btn-sm repeat" onclick="repet()">+</button>
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




