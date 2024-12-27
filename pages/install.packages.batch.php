<?php

use FriendsOfRedaxo\DefaultAddons\DefaultAddons;

$DefaultAddons = new DefaultAddons;


$form = rex_config_form::factory('default_addons');


$field = $form->addTextAreaField('addonlist', null, ["data-addon-json" => true, "class" => "form-control _codemirror", "rows" => "12"]);
$field->setLabel('');

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $this->i18n('default_addons_settings'), false);
$fragment->setVar('body', $form->get(), false);

?>
<div class="row">
    <div class="col-12 col-md-6" style="position: sticky; top: 40px;">
        <div>
            <?= $fragment->parse('core/page/section.php'); ?>
        </div>

        <?php
        
        $installableAddons = DefaultAddons::getProjectAddons();
        
        if (rex_post('install', 'boolean')) {
        
            $aResult = DefaultAddons::installAddons($installableAddons);
            $aError = $aResult["error"];
            $aSuccess = $aResult["success"];
        
        
            // show result messages
            if (count($aError) > 0) {
                echo rex_view::error("<p>" . $this->i18n('installation_error') . "</p><ul><li>" . implode("</li><li>", $aError) . "</li></ul>");
            }
            if (!count($aError) or count($aSuccess) > 0) {
                echo rex_view::success("<p>" . $this->i18n('installation_success') . "</p><ul><li>" . implode("</li><li>", $aSuccess) . "</li></ul>");
            }
        }
        
        
        /* setup info */
        if (!count($installableAddons)) {
            echo rex_view::error("<p>" . $this->i18n('error_no_addons') . "</p>");
        }
        $content = '<p>' . $this->i18n('install_description') . '</p>';
        if (count($installableAddons)) {
            $content .= '<p><b>Folgende Addons sollen installiert werden:</b></p><ul>';
        
            $errors = array();
        
            foreach ($installableAddons as $sPackage => $sVersion) {
                $oPackage = rex_package::get($sPackage);
                $content .= '<li>' . $sPackage . ' (' . $sVersion . ')';
                if ($oPackage->isAvailable()) {
                    $content .= ' - bereits aktiv';
                }
                $content .= '</li>';
            }
            $content .= '</ul><br>';
        
        
            $content .= '<p><button class="btn btn-send" type="submit" name="install" value="1"><i class="rex-icon fa-download"></i> ' . $this->i18n('install_button') . '</button></p>';
        }
        $fragment = new rex_fragment();
        $fragment->setVar('title', $this->i18n('install_heading'), false);
        $fragment->setVar('body', $content, false);
        $content = $fragment->parse('core/page/section.php');
        
        $content = '
        <form action="' . rex_url::currentBackendPage() . '" method="post" data-confirm="' . $this->i18n('confirm_setup') . '">
            ' . $content . '
        </form>';
        
        echo $content;

        ?>
    </div>
    <div class="col-12 col-md-6">
    <div class="alert alert-info">
            <p>Infos und Beispiele gibt es auf der <a href="
            <?php
            echo rex_url::backendPage('packages', ['subpage' => 'help', 'package' => 'default_addons']);
            ?>">Hilfeseite</a></p>
            </div>
        <table class="table addon-table">
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Version</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Verfügbare Addons des Installers auslesen
                $array = rex_install_packages::getAddPackages();
                $addons = [];

                foreach ($array as $addon_key => $package) {
                    $versions = $package['files'];
                    $i = 0;
                    $version_list = [];
                    foreach ($versions as $version_key => $version) {
                        if ($i > 5) {
                            break;
                        }
                        $version_list[] = $version['version'];
                        $i++;
                    }
                    $addons[$addon_key] = $version_list;
                }

                foreach ($addons as $addon_key => $versions) {
                ?>
                    <tr>
                        <td> <strong><?= $addon_key ?></strong>
                        </td>
                        <td>
                            <span class="badge bg-success" data-addon-key="<?= $addon_key ?>" data-addon-version="">latest</span>
                            <?php
                            foreach ($versions as $version) {
                                    $badge = '<span class="badge bg-info" data-addon-key="'.$addon_key.'" data-addon-version="'.$version.'">' . $version . '</span> ';
                                echo $badge;
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
        </table>

    </div>
</div>
<script>
// Wenn ein Badge mit einer Version angeklickt wurde, dann wird die Version in das Textarea-Feld als JSON eingefügt

document.querySelectorAll('.addon-table .badge').forEach(item => {
    item.addEventListener('click', event => {
        let addonlist = document.querySelector('textarea[data-addon-json]');
        let addon_key = item.getAttribute('data-addon-key');
        let addon_version = item.getAttribute('data-addon-version');
        let json = JSON.parse(addonlist.value);
        if (json === null) {
            json = {};
        }
        json[addon_key] = addon_version;
        // Falls codemirror aktiv ist, dann Wert auch dort einfügen:
        // document.querySelector('textarea[data-addon-json]').CodeMirror.setValue(JSON.stringify(json, null, 2));

        addonlist.value = JSON.stringify(json, null, 2);
    })
})

// Highlight the selected addon via tr bg-class, if exists in the textarea and in list
document.querySelectorAll('.addon-table .badge').forEach(item => {
    let addonlist = document.querySelector('textarea[data-addon-json]');
    let json = JSON.parse(addonlist.value);
    if (json === null) {
        json = {};
    }
    let addon_key = item.getAttribute('data-addon-key');
    let addon_version = item.getAttribute('data-addon-version');
    if (json[addon_key] === addon_version) {
        item.classList.add('bg-light');
    }
})

</script>
