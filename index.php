<?php

use Framadate\Services\LogService;
/**
 * This software is governed by the CeCILL-B license. If a copy of this license
 * is not distributed with this file, you can obtain one at
 * http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.txt
 *
 * Authors of STUdS (initial project): Guilhem BORGHESI (borghesi@unistra.fr) and Raphaël DROZ
 * Authors of Framadate/OpenSondage: Framasoft (https://github.com/framasoft)
 * Authors of Selectorrr: Piraten.Tools (https://github.com/Piraten-Tools)
 *
 * =============================
 *
 * Ce logiciel est régi par la licence CeCILL-B. Si une copie de cette licence
 * ne se trouve pas avec ce fichier vous pouvez l'obtenir sur
 * http://www.cecill.info/licences/Licence_CeCILL-B_V1-fr.txt
 *
 * Auteurs de STUdS (projet initial) : Guilhem BORGHESI (borghesi@unistra.fr) et Raphaël DROZ
 * Auteurs de Framadate/OpenSondage : Framasoft (https://github.com/framasoft)
 * Auteurs de Selectorrr: Piraten.Tools (https://github.com/Piraten-Tools)
 */

use Framadate\Services\PollService;
use Framadate\Utils;

include_once __DIR__ . '/app/inc/init.php';

if (!is_file(CONF_FILENAME)) {
    header(('Location: ' . Utils::get_server_name() . 'admin/check.php'));
    exit;
}

/* SERVICES */
/* -------- */
$pollService = new PollService(new LogService());

/* PAGE */
/* ---- */

$demoPoll = $pollService->findById('aqg259dth55iuhwm');
$nbcol = max( $config['show_what_is_that'] + $config['show_the_software'] + $config['show_cultivate_your_garden'], 1 );

$smarty->assign('show_what_is_that', $config['show_what_is_that']);
$smarty->assign('show_the_software', $config['show_the_software']);
$smarty->assign('show_cultivate_your_garden', $config['show_cultivate_your_garden']);
$smarty->assign('col_size', 12 / $nbcol);
$smarty->assign('demo_poll', $demoPoll);

$smarty->assign('title', __('Generic', 'Make your polls'));

$smarty->display('index.tpl');
