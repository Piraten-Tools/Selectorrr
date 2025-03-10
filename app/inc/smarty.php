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
use Framadate\Utils;

global $locale;
global $ALLOWED_LANGUAGES;
global $date_format;

require_once __DIR__ . '/../../vendor/smarty/smarty/libs/Smarty.class.php';
$smarty = new \Smarty();
$smarty->setTemplateDir(ROOT_DIR . '/tpl/');
$smarty->setCompileDir(ROOT_DIR . COMPILE_DIR);
$smarty->setCacheDir(ROOT_DIR . '/cache/');
$smarty->caching = false;

$smarty->assign('APPLICATION_NAME', NOMAPPLICATION);
$smarty->assign('SERVER_URL', Utils::get_server_name());
$smarty->assign('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);
$smarty->assign('TITLE_IMAGE', IMAGE_TITRE);
$smarty->assign('use_nav_js', strstr($_SERVER['SERVER_NAME'], 'framadate.org'));
$smarty->assign('provide_fork_awesome', !isset($config['provide_fork_awesome']) || $config['provide_fork_awesome']);
$smarty->assign('locale', $locale);
$smarty->assign('langs', $ALLOWED_LANGUAGES);
$smarty->assign('date_format', $date_format);
if (isset($config['tracking_code'])) {
    $smarty->assign('tracking_code', $config['tracking_code']);
}
if (defined('FAVICON')) {
    $smarty->assign('favicon', FAVICON);
}

// Dev Mode
if (isset($_SERVER['FRAMADATE_DEVMODE']) && $_SERVER['FRAMADATE_DEVMODE']) {
    $smarty->force_compile = true;
    $smarty->compile_check = true;
} else {
    $smarty->force_compile = false;
    $smarty->compile_check = false;
}

function smarty_function_poll_url($params, Smarty_Internal_Template $template): string
{
    $poll_id =  filter_var($params['id'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => POLL_REGEX]]);
    $admin = isset($params['admin']) && $params['admin'];
    $action =  (isset($params['action']) && !empty($params['action'])) ? Utils::htmlEscape($params['action']) : false;
    $action_value = (isset($params['action_value']) && !empty($params['action_value'])) ? $params['action_value'] : false;
    $vote_unique_id = isset($params['vote_id']) ? filter_var($params['vote_id'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => POLL_REGEX]]) : '';

    // If filter_var fails (i.e.: hack tentative), it will return false. At least no leak is possible from this.

    return Utils::getUrlSondage($poll_id, $admin, $vote_unique_id, $action, $action_value);
}

function smarty_modifier_markdown(string $md, bool $clear = false, bool $inline=true): string
{
    return Utils::markdown($md, $clear, $inline);
}

function smarty_modifier_resource(string $link): string
{
    return Utils::get_server_name() . $link;
}
function smarty_modifier_addslashes_single_quote(string $string): string
{
    return addcslashes($string, '\\\'');
}

function smarty_modifier_addslashes(string $string): string
{
    return addslashes($string);
}

function smarty_modifier_html(?string $html): string
{
    if (!$html) {
        return '';
    }
    return Utils::htmlEscape($html);
}

function smarty_modifier_html_special_chars(string $html): string
{
    return Utils::htmlMailEscape($html);
}

function smarty_modifier_datepicker_path(string $lang): string
{
    $i = 0;
    while (!is_file(path_for_datepicker_locale($lang)) && $i < 3) {
        $lang_arr = explode('-', $lang);
        if ($lang_arr && count($lang_arr) > 1) {
            $lang = $lang_arr[0];
        } else {
            $lang = 'en';
        }
        ++$i;
    }
    return 'js/locales/bootstrap-datepicker.' . $lang . '.js';
}

function smarty_modifier_locale_2_lang(string $locale): string
{
    $lang_arr = explode('-', $locale);
    if ($lang_arr && count($lang_arr) > 1) {
        return $lang_arr[0];
    }
    return $locale;
}

function smarty_modifier_intl_date_format($date, string $pattern): string {
    return formatDate($pattern, $date);
}

function path_for_datepicker_locale(string $lang): string
{
    return __DIR__ . '/../../js/locales/bootstrap-datepicker.' . $lang . '.js';
}
