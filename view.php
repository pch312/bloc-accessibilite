<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * Enregistrements des paramétres de l'utilisateur
 *
 * @package     block_accessibilite
 * @copyright   2022 Philippe CHATAIGNER
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(__DIR__. '/../../config.php');
require_once('lib.php');
require_once('accessibilite_form.php');
global $DB;

require_login();


$simplehtml = new accessibilite_form();


if ($simplehtml->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/my' , [ 'sesskey' => sesskey ()]);
    redirect($courseurl);
} else if ($fromform = $simplehtml->get_data()) {
    // We need to add code to appropriately act on and store the submitted data
    // but for now we will just redirect back to the course main page.

    if ($fromform->submitbutton != '' ) {
        require_sesskey ();
        block_accessibilite_store($fromform->block_accessibilite_code);
    } else {
        require_sesskey ();
        block_accessibilite_store('');
    }
    $courseurl = new moodle_url('/my');
    redirect($courseurl);
} else {
    // Form didn't validate or this is the first display.
    $site = get_site();
    echo $OUTPUT->header();
    echo $OUTPUT->footer();
}
