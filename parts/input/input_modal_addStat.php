<!-- Modal -->
<div class="modal fade" id="addStatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStatTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="addStatCategoryForm" class="form-inline">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="badge badge-secondary">Select Category:</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel passLabel">Completions</span>
                                            <span class="badge badge-secondary statLabel rushLabel">Attempts</span>
                                            <span class="badge badge-secondary statLabel recLabel">Receptions</span>
                                            <span class="badge badge-secondary statLabel defLabel">Tackles</span>
                                            <span class="badge badge-secondary statLabel retLabel">Kick Returns</span>
                                            <span class="badge badge-secondary statLabel kickLabel">XP Made</span>
                                            <span class="badge badge-secondary statLabel puntLabel">Punt Attempts</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel passLabel">Attempts</span>
                                            <span class="badge badge-secondary statLabel rushLabel">Yards</span>
                                            <span class="badge badge-secondary statLabel recLabel">Yards</span>
                                            <span class="badge badge-secondary statLabel defLabel">For Loss</span>
                                            <span class="badge badge-secondary statLabel retLabel">Kick Return Yards</span>
                                            <span class="badge badge-secondary statLabel kickLabel">XP Attempts</span>
                                            <span class="badge badge-secondary statLabel puntLabel">Punt Yards</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel passLabel">Yards</span>
                                            <span class="badge badge-secondary statLabel rushLabel">TDs</span>
                                            <span class="badge badge-secondary statLabel recLabel">TDs</span>
                                            <span class="badge badge-secondary statLabel defLabel">Sacks</span>
                                            <span class="badge badge-secondary statLabel retLabel">Kick Return TDs</span>
                                            <span class="badge badge-secondary statLabel kickLabel">FG Made</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel passLabel">TDs</span>
                                            <span class="badge badge-secondary statLabel defLabel">INTs</span>
                                            <span class="badge badge-secondary statLabel retLabel">Punt Returns</span>
                                            <span class="badge badge-secondary statLabel kickLabel">FG Attempts</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel passLabel">INTs</span>
                                            <span class="badge badge-secondary statLabel defLabel">INT TDs</span>
                                            <span class="badge badge-secondary statLabel retLabel">Punt Return Yards</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel passLabel">Rate</span>
                                            <span class="badge badge-secondary statLabel defLabel">Pass Def</span>
                                            <span class="badge badge-secondary statLabel retLabel">Punt Return TDs</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel defLabel">QB Hurries</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel defLabel">Fumble Rec</span>
                                        </th>
                                        <th>
                                            <span class="badge badge-secondary statLabel defLabel">Fumble TDs</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select id="statCategory" name="statCategory" class="form-control">
                                                <option value=""></option>
                                                <option id="statOptionPassing" value="pass">Passing</option>
                                                <option id="statOptionRushing" value="rush">Rushing</option>
                                                <option id="statOptionRec" value="rec">Receiving</option>
                                                <option id="statOptionDef" value="def">Defense</option>
                                                <option id="statOptionRet" value="ret">Returns</option>
                                                <option id="statOptionKicking" value="kick">Kicking</option>
                                                <option id="statOptionPunting" value="punt">Punting</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput passInput" name="passComp" style="width: 75px">
                                            <input type="text" class="form-control statInput rushInput" name="rushAtt" style="width: 75px">
                                            <input type="text" class="form-control statInput recInput" name="recRec" style="width: 75px">
                                            <input type="text" class="form-control statInput defInput" name="defTak" style="width: 75px">
                                            <input type="text" class="form-control statInput retInput" name="retKRRet" style="width: 75px">
                                            <input type="text" class="form-control statInput kickInput" name="kickXPM" style="width: 75px">
                                            <input type="text" class="form-control statInput puntInput" name="puntAtt" style="width: 75px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput passInput" name="passAtt" style="width: 75px">
                                            <input type="text" class="form-control statInput rushInput" name="rushYards" style="width: 75px">
                                            <input type="text" class="form-control statInput recInput" name="recYards" style="width: 75px">
                                            <input type="text" class="form-control statInput defInput" name="defLoss" style="width: 75px">
                                            <input type="text" class="form-control statInput retInput" name="retKRYards" style="width: 75px">
                                            <input type="text" class="form-control statInput kickInput" name="kickXPA" style="width: 75px">
                                            <input type="text" class="form-control statInput puntInput" name="puntYards" style="width: 75px">

                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput passInput" name="passYards" style="width: 75px">
                                            <input type="text" class="form-control statInput rushInput" name="rushTDs" style="width: 75px">
                                            <input type="text" class="form-control statInput recInput" name="recTDs" style="width: 75px">
                                            <input type="text" class="form-control statInput defInput" name="defSack" style="width: 75px">
                                            <input type="text" class="form-control statInput retInput" name="retKRRetTDs" style="width: 75px">
                                            <input type="text" class="form-control statInput kickInput" name="kickFGM" style="width: 75px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput passInput" name="passTDs" style="width: 75px">
                                            <input type="text" class="form-control statInput defInput" name="defINTs" style="width: 75px">
                                            <input type="text" class="form-control statInput retInput" name="retPRRet" style="width: 75px">
                                            <input type="text" class="form-control statInput kickInput" name="kickFGA" style="width: 75px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput passInput" name="passINTs" style="width: 75px">
                                            <input type="text" class="form-control statInput defInput" name="defINTTDs" style="width: 75px">
                                            <input type="text" class="form-control statInput retInput" name="retPRRetYards" style="width: 75px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput passInput" name="passRate" style="width: 75px">
                                            <input type="text" class="form-control statInput defInput" name="defPassDef" style="width: 75px">
                                            <input type="text" class="form-control statInput retInput" name="retPRRetTDs" style="width: 75px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput defInput" name="defQBHurries" style="width: 75px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput defInput" name="defFumRec" style="width: 75px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control statInput defInput" name="defFumTDs" style="width: 75px">
                                        </td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <td colspan="10">
                                            <input type="hidden" id="Stat_GM_ID" name="GM_ID" value="">
                                            <input type="hidden" name="Player_ID" value="<?php echo returnPlayerMasterID($inputAddPlayer); ?>">
                                            <button class="btn btn-success" type="submit">Add Stats</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>