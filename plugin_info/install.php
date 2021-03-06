<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';

function kroomba_install() {

}

function kroomba_update() {
    // Remove obsolete log.
    log::remove('kroomba_dep');

    foreach (eqLogic::byType('kroomba') as $eqLogic) {
        $cmdlogic = $eqLogic->getCmd(null, 'mission');
        if (!is_object($cmdlogic)) continue;
        $cmdlogic->setLogicalId('refresh');
        $cmdlogic->save();
    }

    $dependencyInfo = kroomba::dependancy_info();
    if (!isset($dependencyInfo['state'])) {
        message::add('kroomba', __('Veuilez vérifier les dépendances', __FILE__));
    } elseif ($dependencyInfo['state'] == 'nok') {
        message::add('kroomba', __('Cette mise à jour nécessite absolument de relancer les dépendances même si elles apparaissent vertes', __FILE__));
    }
}

function template_remove() {

}

?>
