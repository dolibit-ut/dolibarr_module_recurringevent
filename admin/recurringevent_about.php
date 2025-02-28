<?php

/* Copyright (C) 2019 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * 	\file		admin/recurringevent_about.php
 * 	\ingroup	recurringevent
 * 	\brief		This file is an example about page
 * 
 */

// Dolibarr environment
$res = @include '../../main.inc.php'; // From htdocs directory
if (! $res) {
    $res = @include '../../../main.inc.php'; // From "custom" directory
}

// Libraries
require_once DOL_DOCUMENT_ROOT . '/core/lib/admin.lib.php';
require_once '../lib/recurringevent.lib.php';

// Translations
$langs->load('recurringevent@recurringevent');

// Access control
if (! $user->admin) {
    accessforbidden();
}


/*
 * View
 */

$page_name = 'RecurringEventAbout';
llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'
    . $langs->trans('BackToModuleList') . '</a>';
print load_fiche_titre($langs->trans($page_name), $linkback);

// Configuration header
$head = recurringeventAdminPrepareHead();
dol_fiche_head(
    $head,
    'about',
    $langs->trans('Module104903Name'),
    0,
    'recurringevent@recurringevent'
);

// About page goes here
print '<div style="float: left;"><img src="../img/Dolibarr_Preferred_Partner_logo.png" /></div>';
print '<div>'.$langs->trans('ATMAbout').'</div>';

dol_fiche_end();

print '<br><div class="center">';
print '<a href="http://www.atm-consulting.fr" target="_blank"><img src="../img/ATM_logo.jpg" /></a>';
print '</div>';

llxFooter();
$db->close();
