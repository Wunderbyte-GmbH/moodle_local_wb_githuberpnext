<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin upgrade steps are defined here.
 *
 * @package     local_wb_githuberpnext
 * @category    upgrade
 * @copyright   2023 Wunderbyte GmbH <info@wunderbyte.at>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute local_wb_githuberpnext upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_wb_githuberpnext_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2024011400) {

        // Define field action to be added to local_wb_githuberpnext_tasks.
        $table = new xmldb_table('local_wb_githuberpnext_tasks');
        $field = new xmldb_field('action', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'json');

        // Conditionally launch add field action.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('project', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'action');

        // Conditionally launch add field project.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Wb_githuberpnext savepoint reached.
        upgrade_plugin_savepoint(true, 2024011400, 'local', 'wb_githuberpnext');
    }

    return true;
}
