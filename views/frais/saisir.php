<div class="bg-info col-md-10" id="content" data-pg-collapsed>
    <div id="fraisforfait">
        <form id="formff" action="valfraisforfaits" method="post">
        <div class="row">

            <h3>Frais au forfait</h3>
            <div id="atk" class=""></div>

                <div>
                    <div class="repeat1">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label" for="formInput20">Type

                                    <select id="formInput20" class="type form-control" name="type[]">
                                        <?php foreach ($this->getLestypes as $key => $value) : ?>
                                            <option
                                                value="<?php echo $value['id'] ?>"><?php echo $value['libelle'] ?></option>
                                        <? endforeach; ?>
                                    </select></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label" for="formInput27">Quantité - Nombres
                                    <input type="text" class="quantite form-control number-only"
                                           name="quantite[]"></label>
                            </div>
                        </div>
                    </div>
                    <div id="repetition1">

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="control-label" for="formInput12">Ajouter
                            <button type="button" class="btn btn-primary btn-sm repeatx" onclick="repet2()">+</button>
                        </label>
                    </div>
                </div>


        </div>
            <div class="row" data-pg-hidden>
                <div class="text-right col-md-12">
                    <button id="btn1" type="submit" class="btn btn-primary">Valider</button>

                </div>

            </div>
        </form>
    </div>
    <hr id="separateur1"/>
    <?php if (empty($this->LesFraisForfait)): ?>
        <h3>Pas De Frais Au Forfait</h3>
    <?php else : ?>
        <div id="fichefrais">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <form action="majfraisforfait" method="post" id="formupdate">
                            <h3>Au Forfait</h3>
                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                            <tr class="bg-primary">
                                <th>Forfait Etape</th>
                                <th>Nuitée Hotel</th>
                                <th>Frais Kilometriques</th>
                                <th>Repas Midi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td><label><input value="<?php echo $this->LesFraisForfait[0]['quantite'] ?>"
                                                  type="text"
                                                  class="form-control number-only" id="etape" name="ff_etape"></label>
                                </td>
                                <td><label><input value="<?php echo $this->LesFraisForfait[1]['quantite'] ?>"
                                                  type="text"
                                                  class="form-control number-only" id="hotel" name="ff_hotel"></label>
                                </td>
                                <td><label><input value="<?php echo $this->LesFraisForfait[2]['quantite'] ?>"
                                                  type="text"
                                                  class="form-control number-only" id="km" name="ff_km"></label></td>
                                <td><label><input value="<?php echo $this->LesFraisForfait[3]['quantite'] ?>"
                                                  type="text"
                                                  class="form-control number-only" id="repas" name="ff_repas"></label>
                                </td>
                                    <td>
                                        <button id="btn3" type="submit" class="btn btn-primary btn-block">mettre a
                                            jour
                                        </button>
                                    </td>

                            </tr>
                            </tbody>
                        </table>
                        </form>
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
                        <h3>Hors Forfait</h3>
                        <table class="table table-bordered table-hover table-striped table-condensed">
                            <thead>

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
    <form id="myform" action="valfraishorforfaits" method="post">
    <div class="row">
            <div class="repeat2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="formInput29">Date
                            <input type="text" class="datepicker form-control" name="date_hf[]"></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="formInput25">Description

                            <input type="text" class="desc form-control" name="libelle_hf[]"></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="formInput7">Montant

                            <input type="text" class="montant form-control number-only" name="montant[]"></label>
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


    </div>
        <hr id="separateur3">
        <div class="row">

            <div class="col-md-10">
                <label class="control-label" for="formInput7">Nombre De Justificatifs
                    <input type="text" class="montant form-control number-only" name="justif" value="<?php echo $this->LesFraisForfait[0]['nb_justificatifs'] ?>"></label>
            </div>
            <div class="text-right col-md-2">
                <br>
                <button id="btn2" type="submit" class="btn btn-primary">Valider</button>
            </div>

        </div>
        <div class="row">

        </div>
    </form>
</div>



