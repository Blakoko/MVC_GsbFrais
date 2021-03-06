<div class="col-md-10 bg-warning">
    <div class="row" id="Suivi">
        <h1>Suivi des fiches</h1>
        <div class="col-md-4">
            <h4>Choisir le mois :</h4>
        </div>
        <form action="" method="post">
            <div class="col-md-4">
                <label>
                    <select class="form-control" name="mois">
                        <option>--Choisir Un Mois--</option>
                        <?php foreach ($this->ToutLesMois as $key => $value): ?>
                        <option value="<?php echo $value['mois'] ?>"><?php echo $value['mois'] ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
            </div>

            <div class="col-md-4 text-center">
                <button type="submit" class="btn btn-default">Valider</button>
            </div>
        </form>
    </div>
    <hr/>
    <div class="row" id="Fiche">
        <h1>Fiches de Frais a valider et mise en paiement</h1>
        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover table-condensed" id="products">
                <thead>
                <tr>
                    <th>#</th>
                    <th>NOM</th>
                    <th>DATE D'AJOUT</th>
                    <th>STATUT</th>
                    <th>Situation</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($this->Lesinfos as $key => $value): ?>

                    <tr class="repeat">
                        <td><?php echo $value['idfiche'] ?></td>
                        <td><?php echo $value['nom'] ?></td>
                        <td><?php echo $value['date'] ?></td>
                        <td><?php echo $value['libelle'] ?></td>
                        <td>
                            <form class="sForm<?php echo $key ?>" action="popup" method="post">
                                <input class="id" name="id" type="hidden" value="<?php echo $value['id'] ?>">
                                <input class="mois" name="mois" type="hidden" value="<?php echo $value['mois'] ?>">
                                <button type="button" class="loadModal btn btn-default">Afficher</button>
                            </form>
                        </td>
                    </tr>


                <?php endforeach ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VALIDATION DES FICHES</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>

 
