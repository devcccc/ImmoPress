<?php

$immo_terms = get_option('immopress_cats');

/*
unset($immo_terms['rent']['APARTMENTRENT']['fields'][0]);
unset($immo_terms['rent']['APARTMENTRENT']['fields']['ghjghj']);
//array_pop($immo_terms);
update_option('immopress_cats', $immo_terms);

/*echo '<pre>';
print_r($immo_terms);
echo '</pre>';*/

$groups = get_option('immopress_groups');

$vals = get_option('immopress_values');

if(isset($_POST['immopress_save'])) {
    $field_data = $_POST;

    $immo_terms = update_immo_terms($field_data, $immo_terms, $groups);
}

if(isset($_POST['group_save'])) {
    $group_data = $_POST["groupname"];

    $groups = update_groups($group_data);
}

if(isset($_POST['delete-btn'])) {
    $group_id = $_POST["delete-btn"];

    $groups = delete_group($group_id);
}

if(isset($_POST['fieldsaver'])) {
    $fields = $_POST;

    unset($fields['fieldsaver']);

    update_option('immopress_values', $fields);

    $vals = $fields;
}
?>

<div id="immo-tabs">
    <ul>
        <li><a href="#field-tab"><?php _e('Feldübersicht', 'immopress'); ?></a></li>
        <li><a href="#group-tab"><?php _e('Gruppen', 'immopress'); ?></a></li>
        <li><a href="#trans-tab"><?php _e('Feldwertübersetzungen', 'immopress'); ?></a></li>
    </ul>
    <div id="field-tab">
        <form method="post" action="" class="group-form">
            <div class="group_default">
                <h3>Mieten</h3>
                <?php
                $term_counter = 0;
                if(sizeof($immo_terms['rent']) > 0) :
                    foreach ($immo_terms['rent'] as $term => $data) : ?>
                        <div class="wp-box group-box">
                            <div class="inner">
                                <div class="group-head">
                                    <h3><?php echo $term; ?></h3>
                                    <input type="hidden" value="<?php echo $term; ?>" name="<?php echo 'termname_' . $term_counter; ?>">
                                    <input type="hidden" value="rent" name="<?php echo 'termparent_' . $term_counter; ?>">
                                    <div class="term-trans">(<input type="text" name="<?php echo 'termtranslation_' . $term_counter; ?>" value="<?php echo $data['translation']; ?>" class="term-translation" />)</div>
                                    <div class="toggle-btn"><span>+</span></div>
                                </div>

                                <div class="field-table">

                                    <div class="field-table-content">

                                        <div class="pos">
                                            <?php for($x = 0; $x <= sizeof($data['fields']); $x++) { ?>
                                                <div class="row">
                                                    <span><?php if($x > 0) { echo $x . '.'; } ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="keys-table">

                                            <div class="row first-row">
                                                <div class="fieldname">
                                                    <strong><?php _e('Feldname', 'immopress'); ?></strong>
                                                </div>

                                                <div class="translation">
                                                    <strong><?php _e('Frontendausgabe', 'immopress'); ?></strong>
                                                </div>

                                                <div class="unit">
                                                    <strong><?php _e('Einheit', 'immopress'); ?></strong>
                                                </div>

                                                <div class="group">
                                                    <strong><?php _e('Gruppe', 'immopress'); ?></strong>
                                                </div>
                                            </div>

                                            <?php
                                            foreach ($data['fields'] as $key => $keydata) : ?>

                                                <div class="row">
                                                    <div class="fieldname">
                                                        <label><?php echo $key; ?></label>
                                                    </div>
                                                    <div class="translation">
                                                        <input type="text" name="<?php echo 'keytranslation_' . $term_counter . '[' . $key . ']'; ?>" value="<?php echo $keydata['translation']; ?>" />
                                                    </div>
                                                    <div class="unit">
                                                        <select name="<?php echo 'keyunit_' . $term_counter . '[' . $key . ']'; ?>">
                                                            <option value="none" <?php if($keydata['unit'] == 'none') : ?>selected<?php endif; ?>></option>
                                                            <option value="meter" <?php if($keydata['unit'] == 'meter') : ?>selected<?php endif; ?>>m</option>
                                                            <option value="squaremeter" <?php if($keydata['unit'] == 'squaremeter') : ?>selected<?php endif; ?>>m²</option>
                                                            <option value="squarekilometer" <?php if($keydata['unit'] == 'sqaurekilometer') : ?>selected<?php endif; ?>>km²</option>
                                                            <option value="euro" <?php if($keydata['unit'] == 'euro') : ?>selected<?php endif; ?>>&euro;</option>
                                                            <option value="dollar" <?php if($keydata['unit'] == 'dollar') : ?>selected<?php endif; ?>>$</option>
                                                            <option value="energy" <?php if($keydata['unit'] == 'energy') : ?>selected<?php endif; ?>>kWh/(m²*a)</option>
                                                            <option value="kilogramm" <?php if($keydata['unit'] == 'kilogramm') : ?>selected<?php endif; ?>>kg/m²</option>
                                                        </select>
                                                    </div>
                                                    <div class="group">
                                                        <select name="<?php echo 'keygroup_' . $term_counter . '[' . $key . ']'; ?>">
                                                            <?php foreach ($groups as $groupkey => $groupval) { ?>
                                                                <option value="<?php echo $groupkey; ?>" <?php if($keydata['group'] == $groupkey) : ?>selected<?php endif; ?>><?php echo $groupval; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            <?php
                                            endforeach; ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        $term_counter++;
                    endforeach;
                endif; ?>
            </div>


            <div class="group_default">
                <h3>Kaufen</h3>
                <?php
                if(sizeof($immo_terms['buy']) > 0) :
                    foreach ($immo_terms['buy'] as $term => $data) : ?>
                        <div class="wp-box group-box">
                            <div class="inner">
                                <div class="group-head">
                                    <h3><?php echo $term; ?></h3>
                                    <input type="hidden" value="<?php echo $term; ?>" name="<?php echo 'termname_' . $term_counter; ?>">
                                    <input type="hidden" value="buy" name="<?php echo 'termparent_' . $term_counter; ?>">
                                    <div class="term-trans">(<input type="text" name="<?php echo 'termtranslation_' . $term_counter; ?>" value="<?php echo $data['translation']; ?>" class="term-translation" />)</div>
                                    <div class="toggle-btn"><span>+</span></div>
                                </div>

                                <div class="field-table">

                                    <div class="field-table-content">

                                        <div class="pos">
                                            <?php for($x = 0; $x <= sizeof($data['fields']); $x++) { ?>
                                                <div class="row">
                                                    <span><?php if($x > 0) { echo $x . '.'; } ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="keys-table">

                                            <div class="row first-row">
                                                <div class="fieldname">
                                                    <strong><?php _e('Feldname', 'immopress'); ?></strong>
                                                </div>

                                                <div class="translation">
                                                    <strong><?php _e('Frontendausgabe', 'immopress'); ?></strong>
                                                </div>

                                                <div class="unit">
                                                    <strong><?php _e('Einheit', 'immopress'); ?></strong>
                                                </div>

                                                <div class="group">
                                                    <strong><?php _e('Gruppe', 'immopress'); ?></strong>
                                                </div>
                                            </div>

                                            <?php
                                            foreach ($data['fields'] as $key => $keydata) : ?>

                                                <div class="row">
                                                    <div class="fieldname">
                                                        <label><?php echo $key; ?></label>
                                                    </div>
                                                    <div class="translation">
                                                        <input type="text" name="<?php echo 'keytranslation_' . $term_counter . '[' . $key . ']'; ?>" value="<?php echo $keydata['translation']; ?>" />
                                                    </div>
                                                    <div class="unit">
                                                        <select name="<?php echo 'keyunit_' . $term_counter . '[' . $key . ']'; ?>">
                                                            <option value="none" <?php if($keydata['unit'] == 'none') : ?>selected<?php endif; ?>></option>
                                                            <option value="meter" <?php if($keydata['unit'] == 'meter') : ?>selected<?php endif; ?>>m</option>
                                                            <option value="squaremeter" <?php if($keydata['unit'] == 'squaremeter') : ?>selected<?php endif; ?>>m²</option>
                                                            <option value="squarekilometer" <?php if($keydata['unit'] == 'sqaurekilometer') : ?>selected<?php endif; ?>>km²</option>
                                                            <option value="euro" <?php if($keydata['unit'] == 'euro') : ?>selected<?php endif; ?>>&euro;</option>
                                                            <option value="dollar" <?php if($keydata['unit'] == 'dollar') : ?>selected<?php endif; ?>>$</option>
                                                            <option value="energy" <?php if($keydata['unit'] == 'energy') : ?>selected<?php endif; ?>>kWh/(m²*a)</option>
                                                            <option value="kilogramm" <?php if($keydata['unit'] == 'kilogramm') : ?>selected<?php endif; ?>>kg/m²</option>
                                                        </select>
                                                    </div>
                                                    <div class="group">
                                                        <select name="<?php echo 'keygroup_' . $term_counter . '[' . $key . ']'; ?>">
                                                            <?php foreach ($groups as $groupkey => $groupval) { ?>
                                                                <option value="<?php echo $groupkey; ?>" <?php if($keydata['group'] == $groupkey) : ?>selected<?php endif; ?>><?php echo $groupval; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            <?php
                                            endforeach; ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        $term_counter++;
                    endforeach;
                endif; ?>
            </div>
            <input type="submit" name="immopress_save" value="Speichern" onclick="return checkValidation()" class="button button-primary button-large immo-btn">
        </form>
    </div>
    <div id="group-tab">
        <form method="post" action="" class="group-form">

            <h3>Neue Gruppe anlegen</h3>
            <div class="wp-box group-box">
                <div class="create-group">
                    <label for="groupname"><strong><?php _e('Gruppenname', 'immopress'); ?></strong></label><input type="text" name="groupname" id="groupname" />
                    <input type="submit" name="group_save" value="<?php _e('Gruppe anlegen', 'immopress'); ?>" class="button button-primary button-large new-group">
                </div>
            </div>
        </form>

        <form method="post" action="" class="group-form">

            <h3>Gruppen</h3>
            <div class="wp-box group-box">
                <div class="groups">

                    <div class="row group-row">
                        <div class="groupname">
                            <p><strong><?php _e('Gruppenname', 'immopress'); ?></strong></p>
                        </div>
                        <div class="groupid">
                            <p><strong><?php _e('Gruppen ID', 'immopress'); ?></strong></p>
                        </div>
                        <div class="delete-group">
                            <p><strong><?php _e('Gruppe löschen', 'immopress'); ?></strong></p>
                        </div>
                    </div>

                    <?php
                    $j = 0;
                    foreach ($groups as $groupkey => $groupval) { ?>

                        <div class="row group-row"<?php if($j % 2 == 0): ?> style="background: #efefef;"<?php endif; ?>>
                            <div class="groupname">
                                <p><strong><?php echo $groupval; ?></strong></p>
                            </div>
                            <div class="groupid">
                                <p><?php echo $groupkey; ?></p>
                            </div>
                            <div class="delete-group">
                                <?php if($j > 0) : ?><button name="delete-btn" type="submit" value="<?php echo $groupkey; ?>" class="delete-link">Gruppe löschen</button><?php endif; ?>
                            </div>
                        </div>

                        <?php
                        $j++;
                    } ?>
                </div>
            </div>
        </form>
    </div>
    <div id="trans-tab">
        <form method="post" action="" class="field-form group-form">

            <h3>Feldwerte</h3>
            <div class="wp-box group-box">
                <div class="groups">
                    <div class="row group-row">
                        <div class="groupname">
                            <p><strong><?php _e('Wert', 'immopress'); ?></strong></p>
                        </div>
                        <div class="groupid">
                            <p><strong><?php _e('Übersetzung', 'immopress'); ?></strong></p>
                        </div>
                    </div>

                    <?php
                    $j = 0;
                    foreach ($vals as $valkey => $val) { ?>

                        <div class="row group-row"<?php if($j % 2 == 0): ?> style="background: #efefef;"<?php endif; ?>>
                            <div class="groupname">
                                <label for="field-<?php echo $j; ?>"><?php echo $valkey; ?></label>
                            </div>
                            <div class="groupid">
                                <input type="text" value="<?php echo $val; ?>" name="<?php echo $valkey; ?>" id="field-<?php echo $j; ?>">
                            </div>
                        </div>

                        <?php
                        $j++;
                    } ?>
                    <input type="submit" name="fieldsaver" value="<?php _e('Feldübersetzungen speichern', 'immopress'); ?>" class="button button-primary button-large immo-btn">
                </div>
            </div>
        </form>
    </div>
</div>
