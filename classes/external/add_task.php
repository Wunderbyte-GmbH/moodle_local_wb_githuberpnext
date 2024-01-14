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
 * This class contains a list of webservice functions related to the Shopping Cart Module by Wunderbyte.
 *
 * @package    local_wb_githuberpnext
 * @copyright  2022 Georg Maißer <info@wunderbyte.at>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types=1);

namespace local_wb_githuberpnext\external;

use context_system;
use external_api;
use external_function_parameters;
use external_value;
use external_single_structure;
use local_wb_githuberpnext\task;
use moodle_exception;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

/**
 * External Service for shopping cart.
 *
 * @package   local_wb_githuberpnext
 * @copyright 2024 Wunderbyte GmbH {@link http://www.wunderbyte.at}
 * @author    Georg Maißer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class add_task extends external_api {

    /**
     * Describes the parameters for execute_params.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'zen' => new external_value(PARAM_TEXT, 'Zen', VALUE_DEFAULT, ''),
            'hook_id' => new external_value(PARAM_INT, 'Hook ID', VALUE_DEFAULT, 0),
            'hook' => new external_value(PARAM_RAW, 'Hook', VALUE_DEFAULT, ''),
            'repository' => new external_value(PARAM_RAW, 'Repository', VALUE_DEFAULT, ''),
            'sender' => new external_value(PARAM_RAW, 'Sender', VALUE_DEFAULT, ''),
        ]);
    }


    /**
     * Webservice for shopping_cart class to add a new item to the cart.
     *
     * @param string $component
     * @param string $area
     * @param int $itemid
     * @param int $userid
     *
     * @return array
     */
    public static function execute(
        string $zen,
        int $hookid,
        string $hook,
        string $repository,
        string $sender): array {
        $params = self::validate_parameters(self::execute_parameters(), [
            'zen' => $zen,
            'hook_id' => $hookid,
            'hook' => $hook,
            'repository' => $repository,
            'sender' => $sender,
        ]);

        require_login();

        $context = context_system::instance();

        self::validate_context($context);

        $data = (object)[
            'zen' => $zen,
            'hookid' => $hookid,
            'hook' => $hook,
            'repository' => $repository,
            'sender' => $sender,
        ];

        task::create($data);

        return [];
    }

    /**
     * Returns result.
     *
     * @return external_single_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'status' => new external_value(PARAM_INT, 'Status', VALUE_DEFAULT, 0),
            ]
        );
    }
}
