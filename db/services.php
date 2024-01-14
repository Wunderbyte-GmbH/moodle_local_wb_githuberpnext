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
 * Webservice to reload table.
 *
 * @package     local_wb_githuberpnext
 * @category    upgrade
 * @copyright   2021 Wunderbyte GmbH <info@wunderbyte.at>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$services = [
        'Wunderbyte Github ERPNext' => [
                'functions' => [
                        'local_wb_githuberpnext_add_task',
                ],
                'restrictedusers' => 1,
                'shortname' => 'local_wb_githuberpnext_external',
                'enabled' => 1,
        ],
];

$functions = [
        'local_wb_githuberpnext_add_task' => [
                'classname' => 'local_wb_githuberpnext\external\add_task',
                'description' => 'Add a task',
                'type' => 'write',
                'capabilities' => '',
                'ajax' => 1,
        ],
];

