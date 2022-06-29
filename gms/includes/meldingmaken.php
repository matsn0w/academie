<form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Melding</label>
                            <?php include("../selectmelding.php"); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Melding Info</label>
                            <input type="text" id="meldinginfo" name="meldinginfo" class="form-control" id="exampleInputEmail1" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Locatie</label>
                            <input type="text" id="locatie" name="locatie" class="form-control" id="exampleInputEmail1" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prioriteit</label>
                            <select id="prio" name="prio" class="form-control">
                                <option disabled>Politie</option>
                                <option value="Prio 1 MT">Prio 1 MT</option>
                                <option value="Prio 1 ZT">Prio 1 ZT</option>
                                <option value="Prio 2">Prio 2</option>
                                <option value="Prio 3">Prio 3</option>
                                <option disabled>Ambulance</option>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="B">B</option>
                                <option disabled>Brandweer</option>
                                <option value="Prio 1">Prio 1</option>
                                <option value="Prio 2">Prio 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <i onclick="submitMelding()" class="form-control" style="width:100px;">Aanmaken</i>
                        </div>
</form>
