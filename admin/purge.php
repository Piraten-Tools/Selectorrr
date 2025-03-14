<?php
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

use Framadate\Services\InputService;
use Framadate\Services\LogService;
use Framadate\Services\PurgeService;
use Framadate\Services\SecurityService;

include_once __DIR__ . '/../app/inc/init.php';
include_once __DIR__ . '/../bandeaux.php';

/* Variables */
/* --------- */

$message = null;

/* Services */
/*----------*/

$logService = new LogService();
$purgeService = new PurgeService($logService);
$securityService = new SecurityService();
$inputService = new InputService();

/* POST */
/*-----*/

$action = $inputService->filterName($_POST['action'] ?? null);

/* PAGE */
/* ---- */

if ($action === 'purge' && $securityService->checkCsrf('admin', $_POST['csrf'])) {
    $count = $purgeService->purgeOldPolls();
    $message = __('Admin', 'Purged:') . ' ' . $count;
}

// Assign data to template
$smarty->assign('message', $message);
$smarty->assign('crsf', $securityService->getToken('admin'));

$smarty->assign('title', __('Admin', 'Purge'));

$smarty->display('admin/purge.tpl');
